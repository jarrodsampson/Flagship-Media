@extends('layouts.dashboard')
@section('page-title', 'Change Your Password')

@section('content')

<div class="container">

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
    
  <h1>Change Password </h1>

	<form method="POST" action="{{ route('change.store') }}">
		@csrf
        @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                    </div><br />
        @endif

		<div class="col-md-10">
		  <div class="mb-3">
			  <label for="old_password" class="form-label">Old Password</label>
			  <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Enter Old Password">
		  </div>

		  <div class="mb-3">
			  <label for="password" class="form-label">Enter New Password</label>
			  <input type="password" name="password" class="form-control" id="password" placeholder="Enter New Password">
		  </div>

		  <div class="mb-3">
			  <label for="confirmer" class="form-label">Retype New Password</label>
			  <input type="password" name="password_confirmation" class="form-control" id="confirmer" placeholder="Retype New Password">
		  </div>

		  <div class="mb-3">
		  	<button type="submit" class="btn btn-primary btn-lg">Change Password</button>
			<a class="btn btn-primary btn-lg" href="{{ URL::previous() }}">Back</a>
		  </div>
		</div>
	</form>

</div>


@endsection