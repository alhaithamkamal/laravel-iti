<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }
    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'describtion' =>  $request->description,
            'user_id' =>  $request->user_id,
            'image' => Post::storePostImage($request)
        ]);
        return new PostResource($post);
    }
}
