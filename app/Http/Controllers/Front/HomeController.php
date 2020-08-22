<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Setting;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
	public function index()
	{
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
}
