<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::all();
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
    public function store()
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

    public function edit($postId)
    {
        return view('posts.edit', [
            'post' => $postId
        ]);
    }
    public function destroy($id)
    {
        // unset($this->posts[$id]);
        // return view('posts.index', ['allPosts' => $this->posts]);
        $singlePost = Post::findOrFail($id);
        $singlePost->delete();
        return redirect()->route('posts.index');
    }
}