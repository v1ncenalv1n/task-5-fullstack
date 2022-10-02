@extends('layouts.app')

@section('content')
<div class="container my-4">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/categories/{{$category['id']}}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" value="{{$id}}" name="user_id">
        <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control " name="name" value="{{ $category['name'] }}">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-auto ">
                <button type="submit" class="btn btn-primary">Update Category</button>
            </div>
            <div class="col-2">
                <a href="/categories" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </form>
</div>
@endsection
