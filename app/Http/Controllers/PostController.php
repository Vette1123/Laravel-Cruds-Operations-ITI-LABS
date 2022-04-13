<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::paginate(15);;
        return view('posts.index', [
            'allPosts' => $posts,
        ]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', [
            'users' => $users,
        ]);
    }
    //to create a new post
    public function store(StorePostRequest $request)
    {
        //some logic to store data in db
        $data = request()->all();
        //insert into database
        Post::create(
            [
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => $data['post_creator'],
            ]
        );
        return to_route('posts.index');
    }
    // to show a single post
    public function show($post)
    {
        $post = Post::find($post);
        // dd($post);
        return view('posts.show', [
            'posts' => $post,
        ]);
    }
    //to edit a post
    public function edit($post)
    {
        $singlePost = Post::findOrFail($post);
        $users = User::all();
        // dd($singlePost);
        return view('posts.edit', [
            'post' => $singlePost,
            'users' => $users,
        ]);
    }
    //update a post
    public function update(UpdatePostRequest $request, $post)
    {
        $singlePost = Post::findOrFail($post);
        $data = request()->all();
        $singlePost->update(
            [
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => $data['post_creator'],
            ]
        );
        return to_route('posts.index');
    }

    //delete a post
    public function destroy($post)
    {
        // Comment::where('id', $commentId)->delete();
        $singlePost = Post::findOrFail($post);
        $singlePost->Comments()->delete();
        $singlePost->delete();
        return to_route('posts.index');
    }
}
