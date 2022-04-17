<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

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
        $data = request()->all();
        $slug = SlugService::createSlug(Post::class, 'slug', $data['title']);
        $path = Storage::putFile('public', request()->file('image'));
        $url = Storage::url($path);

        Post::create(
            [
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => $data['post_creator'],
                'slug' => $slug,
                'image_path' => $url,
            ]
        );
        return to_route('posts.index');
    }
    // to show a single post
    public function show($post)
    {
        $post = Post::find($post);
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
        $path = Storage::putFile('public', request()->file('image'));
        $url = Storage::url($path);
        $slug = SlugService::createSlug(Post::class, 'slug', $data['title']);
        $singlePost->update(
            [
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => $data['post_creator'],
                'slug' => $slug,
                'image_path' => $url,
            ]
        );
        return to_route('posts.index');
    }

    //delete a post
    public function destroy($post)
    {
        // Comment::where('id', $commentId)->delete();

        $singlePost = Post::findOrFail($post);
        $location =  $singlePost->image_path;
        $imageName = basename($location);

        // $imageURL = "D:\DOCS MOHMA\iti\OPEN SOURCE\Larvel\Day 1\Lab1\\example-app\storage\app\public" . '\\' . $imageName;
        // unlink($imageURL);
        $singlePost->Comments()->delete();
        $singlePost->delete();
        return to_route('posts.index');
    }
}
