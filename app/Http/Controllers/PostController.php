<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request = request();
        Post::create([
            'title' => $request->title,
            'describtion' =>  $request->description,
            'user_id' =>  $request->user_id,
        ]);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $post_id = request('post');
        $post = Post::find($post_id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $users = User::all();
        $post_id = request('post');
        $post = Post::find($post_id);
        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $request = request();
        $post = Post::find($request->post);
        $post->update([
            'title' => $request->title,
            'describtion' =>  $request->description,
            'user_id' =>  $request->user_id,
        ]);
        return redirect()->route('posts.show', ['post' => $request->post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $post = Post::find(request('post'));
        $post->delete();
        return redirect()->route('posts.index');
    }
}
