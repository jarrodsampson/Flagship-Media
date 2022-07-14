@extends('layouts.dashboard')
@section('page-title', 'Users') 

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container-fluid px-4">
                        <h1 class="mt-4">Users</h1>
                        <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item active">users</li>
                        </ol>
<div class="container">
  <div class="uper col-md-10">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div><br />
    @endif
    @if(session()->get('error'))
      <div class="alert alert-danger">
        {{ session()->get('error') }}  
      </div><br />
    @endif
    <table class="table table-striped">
      <thead>
          <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Verified</td>
            <td>Status</td>
            <td colspan="2">Action</td>
          </tr>
      </thead>
      <tbody>
          @foreach($users as $user)
          <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>@if($user->email_verified_at) Yes @else No @endif</td>
              <td>@if($user->is_active === 1) Active @else Blocked @endif</td>
              <td><a href="{{ route('user.edit', $user->id)}}" class="btn btn-primary">Edit</a></td>
              <td>
                  <form action="{{ route('user.destroy', $user->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
    <a href="{{ route('user.create')}}" class="btn btn-primary">Create</a>
  <div>
</div>
@endsection