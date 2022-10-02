@extends('front.index')

@section('content')
@foreach ( $articles as $article)
    <div class="card mb-3" style="max-width: 1000px;">
        <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ $article['image'] ? asset('storage/posts/'.$article['image']) : 'https://artsmidnorthcoast.com/wp-content/uploads/2014/05/no-image-available-icon-6.png'}}" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
            <h5 class="card-title">{{  $article['title'] }}</h5>
            <small>Author : {{ $article["user"]["name"] }} </small>
            <p class="card-text"> {{  Str::limit($article['content'], 250)}}</p>
            <a href="/detail/{{$article['id']}}" class="btn btn-primary">Read more</a>
            </div>
        </div>
        </div>
    </div>
@endforeach
@endsection
