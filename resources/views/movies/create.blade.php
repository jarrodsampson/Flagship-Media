@extends('layouts.dashboard')
@section('page-title', 'Create Movie')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container-fluid px-4">
                        <h1 class="mt-4">Create Movie</h1>
                        <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item">Movie</li>
                          <li class="breadcrumb-item active">Create</li>
                        </ol>
<div class="container">
  <div class="card uper col-md-10">
    <div class="card-header">
      Add New Movie
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div><br />
      @endif
        <form method="post" action="{{ route('movies.store') }}">
            <div class="form-group">
                @csrf
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
                <label for="name">Genre:</label>
                <input type="text" class="form-control" name="genre" value="{{ old('genre') }}" />
            </div>
            <button type="submit" class="btn btn-primary">Add Movie</button>
            <a class="btn btn-primary" href="{{ route('movies.index') }}">Cancel</a>
        </form> 
    </div>
  </div> 
</div>
@endsection