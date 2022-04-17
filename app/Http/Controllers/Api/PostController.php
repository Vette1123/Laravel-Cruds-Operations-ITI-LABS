<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //show all posts
    public function index()
    {
        $posts = Post::all();

        return PostResource::collection($posts);
    }
    //show a post
    public function show($postId)
    {
        $post = Post::find($postId);

        return new PostResource($post);
    }
    //store a post
    public function store(StorePostRequest $request)
    {

        //to change the default behavior of the request
        // if(request()->header('Accept') && request()->header('Accept') == 'application/pdf') {
        //     return ' some pdf';
        // }

        $data = $request->all();

        //store the request data in the db
        $post = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
        ]);

        return new PostResource($post);
    }
}
