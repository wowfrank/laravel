<?php

namespace Netcafe\Http\Controllers;

use Illuminate\Http\Request;

use Netcafe\Http\Requests;
use Netcafe\Http\Controllers\Controller;
use Netcafe\Jobs\BlogIndexData;
use Netcafe\Models\Posts;
use Netcafe\Models\Tag;

class BlogController extends Controller
{
    //
    public function index(Request $request) {
		$tag = $request->get('tag');
		$data = $this->dispatch(new BlogIndexData($tag));
		$layout = $tag ? Tag::layout($tag) : 'blog.list';

		return view($layout, $data);
	}

	public function show($slug, Request $request) {
		$post = Posts::with('tags')->whereSlug($slug)->firstOrFail();
		$tag = $request->get('tag');
		if ($tag) {
			$tag = Tag::whereTag($tag)->firstOrFail();
		}

		return view($post->layout, compact('post', 'tag'));
	}

}
