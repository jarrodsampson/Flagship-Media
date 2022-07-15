@extends('layouts.dashboard')
@section('page-title', 'Create Role Or Permission')

@section('content')

<div class="container-fluid px-4">
                        <h1 class="mt-4">Roles & Permissions</h1>
                        <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item">View</li>
                          <li class="breadcrumb-item active">Create</li>
                        </ol>

	<div class="container">
	  <div class="uper col-md-10">
		<h1> Create Role </h1>
		@if ($errors->any())
	        <div class="alert alert-danger">
	          <ul>
	              @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	              @endforeach
	          </ul>
	        </div><br />
	      @endif
	        <form method="post" action="{{ route('roles-permissions.store') }}">
	        	@csrf
	            <div class="form-group">
	                <label for="name">Name:</label>
	                <input type="text" class="form-control" name="name"/>
	                <input type="hidden" class="form-control" name="type" value="role"/>
	            </div>

	            <h2>Add Permissions </h2>
	            <table class="table table-striped">
				      <thead>
				          <tr>
				          	<td></td>
				            <td>Name</td>
				          </tr>
				      </thead>
				      <tbody>
				          @foreach($permissions as $permission)
				          <tr>
				          	  <td><input type="checkbox" name="permissions[]" value="{{$permission->name}}" /> </td>
				              <td>{{$permission->name}}</td>
				          </tr>
				          @endforeach
				      </tbody>
				</table>


	            <button type="submit" class="btn btn-primary">Add Role</button>
	            <a class="btn btn-primary" href="{{ route('roles-permissions.index') }}">Cancel</a>
	        </form>
	  </div>
	  <div class="uper col-md-10">
	  	<h1>Create Permission</h1>
	  	<form method="post" action="{{ route('roles-permissions.store') }}">
	        	@csrf
	            <div class="form-group">
	                <label for="name">Name:</label>
	                <input type="text" class="form-control" name="name"/>
	                <input type="hidden" class="form-control" name="type" value="permission" />
	            </div>

	            
	            <button type="submit" class="btn btn-primary">Add Permission</button>
	        </form>
	  </div>
	</div>

</div>
@endsection