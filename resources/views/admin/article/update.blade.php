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
    <form action="/articles/{{$article['id']}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" value="{{$id}}" name="user_id">
        <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control " name="title" required="" value="{{ $article['title'] }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-10">
                <textarea class="form-control " style="height: 100px" name="content" required="">{{ $article['content']}}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Image URL</label>
            <div class="col-sm-10">
               @if($article["image"])
                <img src="{{ asset('storage/posts/'.$article['image']) }}" alt="" class="w-50 mb-3">
                <input disabled hidden type="img" class="form-control " name="old_image" required="" value="{{ $article['image'] }}">
                @endif
                <input type="file" class="form-control" name="image" >
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
                <select class="form-select " aria-label="Default select example" name="category_id" required="">
                    <option disabled="" value="">Choose...</option>
                    @foreach($categories as $category)
                    <option value="{{ $loop->iteration }}" {{ $category['id'] === $article['category_id'] ? 'selected' : ''}}>{{ $category['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-auto ">
                <button type="submit" class="btn btn-primary">Update Article</button>
            </div>
            <div class="col-2">
                <a href="/articles" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </form>
</div>
@endsection
