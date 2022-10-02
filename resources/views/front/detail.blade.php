@extends('front.index')

@section('content')
<article class="container">
    <h3 class=""><?= $article["title"] ?></h3>
    <p class="text-muted" >Category : {{ $article["category"]["name"] }}</p>
    <img src="{{ asset('storage/posts/'.$article["image"]) }}" width="750" height="400">
    <p>{{$article["content"]}}</p>
</article>
@endsection
