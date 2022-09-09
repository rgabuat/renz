@extends('layouts.app')

@section('title',"My Profile")

@section('content')
<div class="py-3">
   <div class="row">
   <div class=" @role('system admin|system user|system editor') col-lg-12 @endrole col-lg-8">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <h2 class="login-box-msg text-primary text-left px-0"><b>My Profile</b></h2>
          <div class="row">
            <div class="col-lg-6">
              <div class="row">
                <div class="col-6">
                    <div>
                    <p><a href="{{ route('edit-profile') }}" class="btn btn-primary mb-3">EDIT PROFILE</a></p>
                    </div>
                </div>
                <div class="col-lg-6 text-right">
                  <div class="image">
                      <img src=" {{ auth()->user()->profile_image != '' ? asset('storage/'.auth()->user()->profile_image) : 'vendors/dist/img/AdminLTELogo.png' }}" class="border mb-3" alt="avatar">
                  </div>
                </div>
              </div>
            </div>
          </div>
          
                @if (session('status'))
                    <div class="bg-success text-center text-white py-2 mb-3">
                        {{ session('status') }}
                    </div>
                @endif
                
          <form action="{{ url('update-profile/'.auth()->user()->id) }}" method="post" enctype="multipart/form-data">
              @csrf
            @role('company admin')
            <div class="input-group mb-3">
              <input type="text"disabled name="company" class="form-control @error('company') is-invalid @enderror" value="{{ auth()->user()->company[0]->company_name }}" placeholder="Company">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="far fa-building"></span>
                </div>
              </div>
                @error('company')
                    <span class="error invalid-feedback"> {{ $message }}</span>
                @enderror
            </div>
            @endrole
            <div class="row">
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" disabled value="{{ auth()->user()->first_name }}" placeholder="Firstname">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                    @error('firstname')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" disabled value="{{ auth()->user()->last_name }}" placeholder="Lastname">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                    @error('lastname')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" disabled value="{{ auth()->user()->address }}" placeholder="Address">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-map-marker-alt"></span>
                </div>
              </div>
                @error('address')
                    <span class="error invalid-feedback"> {{ $message }}</span>
                @enderror
            </div>
            <div class="row">
            @role('company admin')
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <input type="tel" name="reg_number" class="form-control @error('reg_number') is-invalid @enderror" disabled value="{{ auth()->user()->reg_number }}" placeholder="Registered Number">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-mobile-alt"></span>
                    </div>
                  </div>
                    @error('reg_number')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
            @endrole
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <input type="tel" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" disabled value="{{ auth()->user()->phone_number }}" placeholder="Phone Number">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-phone-alt"></span>
                    </div>
                  </div>
                    @error('phone_number')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" disabled value="{{ auth()->user()->username }}" placeholder="Username">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user-tie"></span>
                    </div>
                  </div>
                    @error('username')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" disabled value="{{ auth()->user()->email }}" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
                @error('email')
                    <span class="error invalid-feedback"> {{ $message }}</span>
                @enderror
            </div>
            @role('system admin|system editor|company admin')
            <div class="form-group">
                <label for="exampleSelectRounded0">Role</label>
                <select disabled class="custom-select" name="role" id="role">
                  <option value="">Select Role</option>
                  @foreach($roles as $role)
                    <option value="{{$role['name']}}" {{ (auth()->user()->roles[0]->name == $role['name']) ? 'selected' : '' }}>{{$role['name']}}</option>
                  @endforeach
                </select>
              </div>
            @endrole
            <!-- <div class="form-group">
                    <label for="image">Profile Image</label>
                    <input type="file" name="image" class="form-control" placeholder="Choose image" id="image">
                    @error('image')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
            </div> -->
            <!-- <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block mb-3">UPDATE PROFILE</button>
              </div>
            </div>
          </form> -->
        </div>
  </div>
   </div>
   @role('company admin|company user')
   <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
      <h2 class="login-box-msg text-primary text-left px-0"><b>Subscription</b></h2>
      <p><span class="font-weight-bold">Credit Balance:</span><b>{{ $credits }}</b></p>
        <hr>
        @if(isset($sub_items_arr))
          @foreach($sub_items_arr as $subs)
            <p><span class="font-weight-bold">Active Package:</span>{{ $subs['id'] }}</p>
            <p><span class="font-weight-bold">Started at:</span>{{ $subs['current_period_start'] }}</p>
            <p><span class="font-weight-bold">Expires at:</span>{{ $subs['current_period_end'] }}</p>
          @endforeach
        @else 
          <p>No Subscribed Plan</p>
        @endif
      </div>
    </div>
  </div>
  @endrole
</div>
<!-- /.login-box -->
</div>
@endsection