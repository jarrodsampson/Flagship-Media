@extends('layouts.dashboard')
@section('page-title', 'Profile')

@section('content')

<div class="container-fluid px-4">
                        <h1 class="mt-4">Profile</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Your Profile</li>
                        </ol>

        <div class="container">
          <div class="main-body">

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
          
                <div class="row gutters-sm">
                  <div class="col-md-4 mb-3">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                          <img src="/uploads/avatars/{{ $user_info->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                          <div class="mt-3">
                            <h4>John Doe</h4>
                            <p class="text-secondary mb-1">{{ $user_info->title ?? 'None' }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Full Name</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $user_info->name ?? 'Not Set' }}
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $user_info->email ?? 'Not Set' }}
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Phone</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $user_info->home_phone ?? 'Not Set' }}
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Mobile</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $user_info->mobile_phone ?? 'Not Set' }}
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Address</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            @if (empty($user_info->address))
                              Not Set
                            @else
                             {{ $user_info->address }} {{ $user_info->city }}, {{ $user_info->state }}, {{ $user_info->zipcode }}
                            @endif
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-12">
                            <a class="btn btn-info " href="{{ route('profile.edit', $user_info->user_id) }}">Edit</a>
                          </div>  
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
          </div>
</div>
@endsection