@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-header ">
                <a class="btn btn-primary" href="/categories/create">Create</a>
            </div>
            <div class="card">
                <table class="table table-light">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ( $categories as $category )
                      <tr>
                        <td>{{$category['name']}}</td>
                        <td>
                            <a class="btn btn-primary" href="categories/{{ $category['id'] }}/edit">Update</a>
                        </td>
                        <td>
                            <form action="/categories/{{ $category['id'] }}" method="post" class="d-inline">
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
