@extends('layouts.dashboard')
@section('page-title', 'Movies')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container-fluid px-4">
                        <h1 class="mt-4">Movies</h1>
                        <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item active">List</li>
                        </ol>
<div class="container">
  <div class="uper col-md-12">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div><br />
    @endif
    @if(session()->get('error'))
      <div class="alert alert-warning">
        {{ session()->get('error') }}  
      </div><br />
    @endif
    <table class="table table-striped" id="datatablesSimple">
      <thead>
          <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Genre</td>
          </tr>
      </thead>
      <tbody>
          @foreach($movies as $movie)
          <tr>
              <td>{{$movie->id}}</td>
              <td>{{$movie->name}}</td>
              <td>{{$movie->genre}}</td>
              <td>
                 <a href="{{ route('movies.edit', $movie->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                 <a href="{{ route('movies.show', $movie->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                 <form action="{{ route('movies.destroy', $movie->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
    <a href="{{ route('movies.create')}}" class="btn btn-primary">New</a>
  <div>
</div>
@endsection