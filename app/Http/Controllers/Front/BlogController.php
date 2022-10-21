<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Bickyraj\Toc\Contents;
use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
	public function index()
	{
		$blogs = Blog::latest()->get();
		return view('front.blogs.index', compact('blogs'));
	}

	public function show($slug, Contents $contents)
	{
        $blog = Blog::where('slug', '=', $slug)->first();
        if ($blog->toc != "") {
            $contents->fromText($blog->toc)->setTags(['h2', 'h3', 'h4'])->setMinLength(100);
            $body = $contents->getHandledText();
            $contents = $contents->getContents();
        } else {
            $body = "";
            $contents = [];
        }
		$blogs = Blog::limit(3)->latest()->get();
        $seo = $blog->seo;
		return view('front.blogs.show', compact('blog', 'blogs', 'seo', 'contents', 'body'));
	}
}
