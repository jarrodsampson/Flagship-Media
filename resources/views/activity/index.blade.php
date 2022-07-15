@extends('layouts.dashboard')
@section('page-title', 'Activity Log') 

@section('content')

<div class="container-fluid px-4">
                        <h1 class="mt-4">Activity Log</h1>
                        <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item active">All</li>
                        </ol>
<div class="container">
  <div class="uper col-md-10">
    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div><br />
    @endif
    <table class="table table-striped">
      <thead>
          <tr>
            <td>ID</td>
            <td>User</td>
            <td>Log</td>
            <td>Time</td>
            <td colspan="2">Action</td>
          </tr>
      </thead>
      <tbody>
          @foreach($activities as $activity)
          <tr>
              <td>{{$activity->id}}</td>
              <td>{{$activity->name}}</td>
              <td>{{$activity->description}}</td>
              <td>{{$activity->created_at}}</td>
              <td>
                  <form action="{{ route('activity.destroy', $activity->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  <div>
</div>

@endsection