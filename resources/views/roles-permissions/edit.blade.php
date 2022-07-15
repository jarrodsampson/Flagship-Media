 @extends('layouts.dashboard')
@section('page-title', 'Edit ' . $role->name . ' Role')

@section('content')

@if(session()->get('error'))
      <div class="alert alert-danger">
        {{ session()->get('error') }}  
      </div><br />
    @endif

<div class="container-fluid px-4">
                        <h1 class="mt-4">Roles & Permissions</h1>
                        <ol class="breadcrumb mb-4">
                          <li class="breadcrumb-item">View</li>
                          <li class="breadcrumb-item active">Edit</li>
                        </ol>

	<div class="container">
	  <div class="uper col-md-10">
		<h1> Role </h1>
		@if ($errors->any())
	        <div class="alert alert-danger">
	          <ul>
	              @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	              @endforeach
	          </ul>
	        </div><br />
	      @endif
	        <form method="post" action="{{ route('roles-permissions.update', $role->id) }}">
	        	@csrf
	            @method('PATCH')
	            <div class="form-group">
	                <label for="name">Name:</label>
	                <input type="text" class="form-control" name="name" value="{{ $role->name }}" />
	            </div>

	            <h2>Edit Permissions </h2>
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
				          	  <td><input type="checkbox" name="permissions[]" value="{{$permission->name}}" @if($role->permissions->contains($permission)) checked @endif /> </td>
				              <td>{{$permission->name}}</td>
				          </tr>
				          @endforeach
				      </tbody>
				</table>

	            <button type="submit" class="btn btn-primary">Edit Role</button>
	        </form>
	        <form action="{{ route('roles-permissions.destroy', $role->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="type" value="role" /> 
                    <button class="btn btn-danger" type="submit">Delete</button>
            </form>
	        <a class="btn btn-primary" href="{{ route('roles-permissions.index') }}">Cancel</a>
	  </div>


	  <h1> Users With This Role: </h1>
	  <table class="table table-striped">
				      <thead>
				          <tr>
				            <td>Name</td>
				            <td></td>
				          </tr>
				      </thead>
				      <tbody>
				          @foreach($users as $user)
				          <tr>
				              <td>{{$user->name}}</td>
				              <td><a href="{{ route('users.edit', $user->id)}}" class="btn btn-primary">View</a></td>
				          </tr>
				          @endforeach
				      </tbody>
				</table>
	</div>



</div>
@endsection