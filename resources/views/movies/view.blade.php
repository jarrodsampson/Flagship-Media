@extends('layouts.dashboard')
@section('page-title', 'Edit Movie')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container-fluid px-4">
                        <h1 class="mt-4">View Movie</h1>
                        <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item">Movie</li>
                          <li class="breadcrumb-item active">View</li>
                        </ol>
<div class="container">
  <div class="card uper col-md-10">
    <div class="card-header">
      View Movie Data
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
        <div>
            <h1>
                {{ $movie->name }}
            </h1>
            <p>
                {{ $movie->genre }}
            </p>
        </div>
    </div>
  </div>
</div>
@endsection