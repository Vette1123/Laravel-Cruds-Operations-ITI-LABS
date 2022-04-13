@extends('layouts.app')

@section('title')Create @endsection

@section('content')
<form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="my-4">
        <label for="exampleFormControlInput1" class="form-label fs-2">Title</label>
        <input name="title" type="text" class="form-control" id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label fs-2">Description</label>
        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>

    <div class="my-3">
        <input class="form-control form-control-lg" name="image" id="formFileLg" type="file">
    </div>


    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label fs-2">Post Creator</label>
        <select name="post_creator" class="form-control">
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-success">Create Post</button>
    </div>
</form>
@endsection