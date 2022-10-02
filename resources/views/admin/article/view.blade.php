@extends('layouts.app')

@section('content')
<article class="container">
    <h3 class=""><?= $article["title"] ?></h3>
    <p class="text-muted" >Category : {{ $article["category"]["name"] }}</p>
    <img src="{{ asset('storage/posts/'.$article["image"]) }}" width="750" height="400">
    <p>{{$article["content"]}}</p>
    <a href="/articles/{{ $article["id"] }}/edit" class="btn btn-primary">Edit</a>
    <form action="/articles/{{ $article["id"] }}" method="post" class="d-inline">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</article>
@endsection
