@extends('layouts.app')

@section('content')
<form method="POST" action="{{route('posts.update',['post' => $post->id])}}">
    @csrf
    @method('PUT')
    <div class="container mt-5">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" id="exampleFormControlInput1" value="{{$post->title}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$post->title}}</textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Post Creator</label>
            <select name="post_creator" class="form-control">
                @foreach($users as $user)
                <option value="{{$user->id}}" @if($user->id == $post->user_id) selected @endif >{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
    </div>
</form>
@endsection