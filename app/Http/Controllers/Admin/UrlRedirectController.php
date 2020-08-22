<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UrlRedirect;

class UrlRedirectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url_redirects = UrlRedirect::get()->toArray();
        return view('admin.urlRedirects.index', compact('url_redirects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.urlRedirects.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'from_url' => 'required',
            'to_url' => 'required',
        ]);

        $status = 0;
        $msg = "";
        $url_redirect = new UrlRedirect;
        $url_redirect->fill($request->all());

        if ($url_redirect->save()) {
            $status = 1;
            $msg = "Redirection created successfully.";
            session()->flash('message', $msg);
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $url_redirect = UrlRedirect::find($id);
        return view('admin.urlRedirects.edit', compact('url_redirect'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'from_url' => 'required',
            'to_url' => 'required'
        ]);

        $status = 0;
        $msg = "";
        $url_redirect = UrlRedirect::find($request->id);
        $url_redirect->fill($request->all());

        if ($url_redirect->save()) {
            $status = 1;
            $msg = "Redirection updated successfully.";
            session()->flash('message', $msg);
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = 0;
        $http_status_code = 400;
        $msg = "";
        if (UrlRedirect::find($id)->delete()) {
            $status = 1;
            $http_status_code = 200;
            $msg = "Redirection has been deleted";
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ], $http_status_code);
    }

    public function faqList()
    {
        $faqs = UrlRedirect::all();
        return response()->json([
            'data' => $faqs
        ]);
    }
}
