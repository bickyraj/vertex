<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InstagramGallery;

class InstagramGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = InstagramGallery::get()->toArray();
        return view('admin.instagramGalleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.instagramGalleries.add');
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
            'embed' => 'required'
        ]);

        $status = 0;
        $msg = "";
        $gallery = new InstagramGallery;
        $gallery->name = $request->name;
        $gallery->embed = $request->embed;
        $gallery->status = 1;

        if ($gallery->save()) {
            $status = 1;
            $msg = "Instagram post created successfully.";
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
        $gallery = InstagramGallery::find($id);
        return view('admin.instagramGalleries.edit', compact('gallery'));
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
            'embed' => 'required'
        ]);

        $status = 0;
        $msg = "";
        $gallery = InstagramGallery::find($request->id);
        $gallery->name = $request->name;
        $gallery->embed = $request->embed;
        $gallery->status = 1;

        if ($gallery->save()) {
            $status = 1;
            $msg = "Instagram post updated successfully.";
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
        if (InstagramGallery::find($id)->delete()) {
            $status = 1;
            $http_status_code = 200;
            $msg = "Instagram post has been deleted";
        }

        return response()->json([
            'status' => $status,
            'message' => $msg
        ], $http_status_code);
    }

    public function faqList()
    {
        $galleries = InstagramGallery::all();
        return response()->json([
            'data' => $galleries
        ]);
    }
}
