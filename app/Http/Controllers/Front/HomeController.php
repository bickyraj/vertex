<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Setting;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Invoice;
use DB;

class HomeController extends Controller
{
	public function index()
	{
        // m1, m2, m3, m4, m5, m6
		$data['banners'] = \App\Banner::all();
		$data['destinations'] = \App\Destination::orderBy('name')->select('id', 'name', 'slug')->get();
		$data['activities'] = \App\Activity::orderBy('name')->select('id', 'name', 'slug')->get();
		$data['block_1_trips'] = \App\Trip::where('block_1', '=', 1)->latest()->get();
		$data['block_2_trips'] = \App\Trip::where('block_2', '=', 1)->latest()->get();
		$data['block_3_trips'] = \App\Trip::where('block_3', '=', 1)->latest()->get();
		$data['reviews'] = \App\TripReview::latest()->limit(4)->published()->get();
		$data['blogs'] = \App\Blog::latest()->limit(3)->get();
        $data['why_chooses'] = \App\WhyChoose::latest()->limit(6)->get();
        $data['instagram_galleries'] = \App\InstagramGallery::latest()->limit(6)->get();
		return view('front.index', $data);
	}

	public function faqs()
	{
		$faqs = \App\Faq::where('status', '=', 1)->get();
		return view('front.faqs.index', compact('faqs'));
	}

	public function reviews()
	{
		$trips = \App\Trip::orderBy('name', 'asc')->select('id', 'name')->get();
		$reviews = \App\TripReview::latest()->published()->get();
		return view('front.tripReviews.index', compact('trips', 'reviews'));
	}

	public function contact()
	{
		return view('front.contacts.index');
	}

	public function contactStore(Request $request)
	{
		$request->validate([
			'name' => 'required'
		]);

		try {
			$request->merge([
				'ip_address' => $request->ip()
			]);
			Mail::send('emails.contact', ['body' => $request], function ($message) use ($request) {
			    $message->to(Setting::get('email'));
			    $message->from($request->email);
			    $message->subject('Enquiry');
			});
			session()->flash('success_message', "Thank you for your enquiry. We'll contact you very soon.");
			$prev_route = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
			if ($prev_route == "front.trips.show") {
				return redirect()->back();
			}

			return redirect()->route('front.contact.index');
		} catch (\Exception $e) {
			Log::info($e->getMessage());
			session()->flash('error_message', __('alerts.save_error'));
			return redirect()->route('front.contact.index');
		}
	}

    public function getFbAccessToken()
    {
        $graph_version = 'v11.0';
        $params = [
           'query' => [
               'url' => 'https://www.instagram.com/p/CHb48AYh-Hq',
               'maxwidth' => '50',
               'fields' => 'thumbnail_url,author_name,provider_name,provider_url',
               'access_token' => '',
           ]
        ];
        $endpoint = "instagram_oembed";

        try {
            $client = new Client([
                // 'base_uri' => 'https://graph.facebook.com',
                // 'timeout'  => 2.0,
            ]);
            $response = $client->request('GET', 'https://www.instagram.com/p/CRgLoinhs7x/media?size=l');

        } catch (RequestException $e) {
            $response = $e->getRequest();
            if ($e->hasResponse()) {
                $response = $e->getResponse();
            }
        }

        return response()->json([
            'data' => $response->getBody()->getContents()
        ], $response->getStatusCode());
    }

    public function payment()
    {
        return view('front.payment.payment');
    }

    public function storePayment(Request $request)
    {
        try {
            // save data to database.
            $invoice = new Invoice();
            $latest_invoice = DB::table('invoices')->latest('id')->first();
            $last_id = $latest_invoice ? $latest_invoice->id: 1;
            $invoice_id = 'IV-' .
            str_pad($last_id, 5, "0", STR_PAD_LEFT);
            $invoice->invoice_id = $invoice_id;
            $invoice->full_name = $request->fullname;
            $invoice->amount = $request->amount;
            $invoice->price = $request->price;
            $invoice->trip_name = $request->trip_name;
            $invoice->email = $request->email;
            $invoice->contact_number = $request->contact_number;
            $invoice->save();
            return redirect()->route('front.redeem_payment', ['id' => $invoice->id]);
        } catch (\Throwable $th) {
            \Log::info($th->getMessage());
            return redirect()->back();
        }
    }

    public function redeemPayment($id)
    {
        $invoice = Invoice::find($id);
        $payment = [];
        $payment['paymentGatewayID'] = config('constants.payment_merchant_id');
        $payment['invoiceNo'] = $invoice->invoice_id;
        $payment['productDesc'] = $invoice->trip_name;
        $payment['price'] =
        str_pad((float) $invoice->price * 100, 12, "0", STR_PAD_LEFT);
        $payment['currencyCode'] = "840";
        $payment['nonSecure'] = "N";
        $payment['hashValue'] = config('constants.payment_merchant_key');

        return view('front.payment.redeem_payment', compact('payment'));
    }
}
