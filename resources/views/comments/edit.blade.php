@extends('layout.app')

@section('title')
{{$post['title']}}
@endsection

@section('content')
<div class=''>
    <h1 class="text-6xl">{{$post['title']}}</h1>
    <p class="text-md italic my-3 text-sm">created by <span class="text-content-base ">{{$post->user ? $post->user->name : 'unknown'}}</span> on {{\Carbon\Carbon::parse($post['created_at'])->format('M-d-Y');}}</p>
    <p class="text-lg mt-6">{{$post['description']}}</p>
</div>
<div class='mt-20 max-w-2xl'>
    @foreach ($post->comments as $cmnt)
    <div class='flex flex-col mt-6 border p-4 rounded-lg border-slate-600'>
        <h2 class='text-lg'>{{$cmnt->user->name}}</h2>
        <p class='text-md'>{{$cmnt->body}}</p>
        <span class='text-sm text-gray-500'>last updated {{$cmnt->updated_at}}</span>
        <div class="flex items-center mt-5">
            <form method='POST' action={{route('comments.delete', ['postId' => $post['id'], 'commentId' => $comment->id])}}>
                @csrf
                @method('DELETE')
                <button type="sumbit" class='btn btn-xs btn-primary'>Delete</button>
            </form>
            <a class='btn btn-xs btn-success ml-4' href={{route('comments.view', ['postId' => $post['id'], 'commentId' => $cmnt->id])}}>
                Edit
            </a>
        </div>
    </div>
    @endforeach
    <div class='flex flex-col mt-6  p-4 rounded-lg'>
        <form method="POST" class='flex items-center' action={{route('comments.update', ['postId' => $post['id'], 'commentId' => $comment->id])}}>
            @csrf
            @method('PATCH')
            <label for="comment" class="label mr-4">Edit comment</label>
            <input class="input flex-1 input-xlg" placeholder="edit comment" type="text" name="comment" id="comment" value={{$comment["body"]}} />
            <button type="sumbit" class='btn btn-info ml-4'>Edit comment</button>
        </form>
    </div>
</div>
@endsection