@extends('layouts.app')

@section('content')
<form>
    @csrf
    @method('PATCH')
    <div class="container mt-5">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <select class="form-select" aria-label="Default select example">Post Creator
            <option value="1">Gado</option>
            <option value="2">Gadoz?</option>
            <option value="3">Gadozzz?</option>
        </select>
        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>
@endsection