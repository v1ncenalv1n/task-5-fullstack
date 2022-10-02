@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card-header ">
                <a class="btn btn-primary" href="/articles/create">Create</a>
            </div>
            <div class="card">
                <table class="table table-light">
                    <thead>
                      <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Image</th>
                        <th scope="col">Update</th>
                        <th scope="col">View</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ( $articles as $article )
                      <tr>
                        <td>{{$article['title']}}</td>
                        <td>{{  Str::limit($article['content'], 100)}}</td>
                        <td><img src="{{ asset('storage/posts/'.$article['image']) }}" width="80" height="50"></td>
                        <td>
                            <a class="btn btn-primary" href="articles/{{ $article['id'] }}/edit">Update</a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="articles/{{ $article['id'] }}">View</a>
                        </td>
                        <td>
                            <form action="/articles/{{ $article['id'] }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection
