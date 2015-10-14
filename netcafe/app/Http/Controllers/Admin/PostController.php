<?php

namespace Netcafe\Http\Controllers\Admin;

use Netcafe\Models\Posts;
use Netcafe\User;
use Redirect;
use Netcafe\Http\Redirect\PostFormRequest;
use Netcafe\Http\Requests\PostCreateRequest;
use Netcafe\Http\Requests\PostUpdateRequest;
use Illuminate\Http\Request;

use Netcafe\Http\Requests;
use Netcafe\Http\Controllers\Controller;
use Netcafe\Jobs\PostFormFields;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return view('admin.post.index')
                    ->withPosts(Posts::all());;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // create a new post
        $data = $this->dispatch(new PostFormFields());

        return view('admin.post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(PostCreateRequest $request)
    {
        //
        // $post = new Posts();
        // $post->title = $request->get('title');
        // $post->body = $request->get('body');
        // $post->slug = str_slug($post->title);
        // if($request->has('save')) {
        //     $post->active = 0;
        //     $message = 'Post saved successfully';   
        // } else {
        //     $post->active = 1;
        //     $message = 'Post published successfully';
        // }
        // $post->save();

        // return redirect('admin/post/'.$post->slug.'/edit/')->withMessage($message);
        $post = Posts::create($request->postFillData());
        $post->syncTags($request->get('tags', []));

        return redirect()
                ->route('admin.post.index')
                ->withSuccess('New Post Successfully Created.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        // $post = Posts::where('slug', $slug)->first();
        // if($post)
        //     return view('admin.post.edit')->with('post', $post);
        // else
        //     return redirect('/admin/post/'.$post->slug.'/edit/')->withErrors('you have not sufficient permissions');

        $data = $this->dispatch(new PostFormFields($id));

        return view('admin.post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(PostUpdateRequest  $request, $id)
    {
        //
        // $post_id = $request->input('post_id');
        // if($post) {
        //     $title = $request->input('title');
        //     $slug = str_slug($title);
        //     $duplicate = Posts::where('slug',$slug)->first();
        //     if($duplicate) {
        //         if($duplicate->id != $post_id)
        //             return redirect('/admin/post/'.$post->slug.'/edit/')->withErrors('Title already exists.')->withInput();
        //         else 
        //             $post->slug = $slug;
        //     }

        //     $post->title = $title;
        //     $post->body = $request->input('body');

        //     if($request->has('save')) {
        //         $post->active = 0;
        //         $message = 'Post saved successfully';
        //         $landing = 'edit/'.$post->slug;
        //     } else {
        //         $post->active = 1;
        //         $message = 'Post updated successfully';
        //         $landing = $post->slug;
        //     }
        //     $post->save();

        //     return redirect($landing)->withMessage($message);
        // } else {
        //     return redirect('/admin/post/'.$post->slug.'/edit/')->withErrors('you have not sufficient permissions');
        // }
        $post = Posts::findOrFail($id);

        $post->fill($request->postFillData());
        $post->save();
        $post->syncTags($request->get('tags', []));

        if ($request->action === 'continue') {
            return redirect()
                ->back()
                ->withSuccess('Post saved.');
        }

        return redirect()
            ->route('admin.post.index')
            ->withSuccess('Post saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $post = Posts::findOrFail($id);
        if($post) {
            $post->tags()->detach();
            $post->delete();
            $data['message'] = 'Post deleted Successfully';
        } else {
            $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }

        return redirect('/admin/post/')->with($data);
        return redirect()
                    ->route('admin.post.index')
                    ->withSuccess('Post deleted.');
    }
}
