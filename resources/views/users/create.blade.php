@extends('layouts.dashboard')
@section('page-title', 'Create User')

@section('content')
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Create User</p>

                <form class="mx-1 mx-md-4" method="POST" action="{{ route('user.store') }}">
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

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" />
                      <label class="form-label" for="name">Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="email" class="form-control" name='email' value="{{ old('email') }}" />
                      <label class="form-label" for="email">Your Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="password" name='password' class="form-control" autocomplete="new-password" />
                      <label class="form-label" for="password">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="retype" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                      <label class="form-label" for="retype">Repeat your password</label>
                    </div>
                  </div>

                  {{-- <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <select name="role">
                        <option value="" selected="selected">--Select Role--</option>
                        @foreach($roles as $role)
                          <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                      </select>
                      <label class="form-label" for="role">Select Role</label>
                    </div>
                  </div> --}}

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg">Create</button>&nbsp;
                    <a class="btn btn-primary btn-lg" href="{{ route('user.index') }}">Back</a> 
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection