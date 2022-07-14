 @extends('layouts.dashboard')
@section('page-title', 'Edit User ' . $user->email)

@section('content')

@if(session()->get('error'))
      <div class="alert alert-danger">
        {{ session()->get('error') }}  
      </div><br />
    @endif

<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-10">
            <div class="row justify-content-center">
              <div class="col-md-12 col-lg-12 col-xl-5 order-2 order-lg-1">
 
                <p class="text-center h1 fw-bold mb-10 mx-1 mx-md-4 mt-4">User<br /> {{ $user->email }}</p>

                <form class="mx-1 mx-md-4" method="POST" action="{{ route('user.update', $user->id) }}">
                	@csrf
                  @method('PATCH') 

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
                    <div class="form-group">
                      <label class="radio-inline">
                        <input type="radio" name="is_active" value="1" @if($user->is_active===1) checked @endif>&nbsp;Active
                      </label>
                      <label class="radio-inline"> 
                        <input type="radio" name="is_active" value="0" @if($user->is_active===0) checked @endif />&nbsp;Blocked
                      </label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" name="name" class="form-control" value="{{ $user->name }}" />
                      <label class="form-label" for="form3Example1c">Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" name="email" class="form-control" value="{{ $user->email }}" />
                      <label class="form-label" for="form3Example3c">Your Email</label>
                    </div>
                  </div>

                  {{-- <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <select name="role">
                        @foreach($roles as $role)
                          <option 
                            value="{{ $role->name }}" 
                            @if($userRoles->contains($role->name)) selected='selected' @endif
                          > 
                            {{ $role->name }}
                          </option>
                        @endforeach
                      </select>
                      <label class="form-label" for="role">Select Role</label>
                    </div>
                  </div> --}}

                  @if(Auth::user()->id === $user->id)

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <a href="{{ route('change.password') }}">Change Password</a> 
                      </div>
                    </div>

                  @endif

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg">Update</button>&nbsp;
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