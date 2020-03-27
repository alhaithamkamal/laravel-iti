<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::Paginate(3);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        Post::create([
            'title' => $request->title,
            'describtion' =>  $request->description,
            'user_id' =>  $request->user_id,
            'image' => Post::storePostImage($request)
        ]);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $users = User::all();
        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {   
        $attributes = [
            [
                'title' => $request->title,
                'describtion' =>  $request->description,
                'user_id' =>  $request->user_id,
            ]
        ];
        if ($request->hasFile('image')){
            $attributes['image'] = Post::storePostImage($request);
            Storage::delete('public/'.$post->image);
        }
        $post->update($attributes);
        return redirect()->route('posts.show', ['post' => $request->post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->image) Storage::delete('public/'.$post->image);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
