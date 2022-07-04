@extends('layouts.app')

@section('title',"Users Create")

@section('content')
<div class="py-3">
    <div class="col-12">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <h2 class="login-box-msg h2 text-center text-primary px-0"><b>Create Account</b></h2>
                @if (session('status'))
                    <div class="bg-success text-center text-white py-2 mb-3">
                        {{ session('status') }}
                    </div>
                @endif
          <form action="{{route('users/store')}}" method="post">
              @csrf
            <div class="row">
              <div class="col-lg-6">
                <label for="firstname">Firstname <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                  <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" placeholder="Firstname">
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
              <label for="lastname">Lastname <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                  <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" placeholder="Lastname">
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
            
            <div class="row">
              <div class="col-12">
                <label for="address">Address<span class="text-danger">*</span></label>
                  <div class="input-group mb-3">
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-map-marker-alt"></span>
                      </div>
                    </div>
                      @error('address')
                          <span class="error invalid-feedback"> {{ $message }}</span>
                      @enderror
                  </div>
                </div>
                <div class="col-md-6">
                <label for="username">Username <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                  <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="Username">
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
              <div class="col-md-6">
                <label for="phone">Phone Number <span class="text-danger">*</span></label>
                  <div class="input-group mb-3">
                    <input type="tel" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" placeholder="Phone Number">
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
                <div class="col-12">
                <label for="email">Email <span class="text-danger">*</span></label>
                  <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                      @error('email')
                          <span class="error invalid-feedback"> {{ $message }}</span>
                      @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="default_pass" class="form-label">Default password:</label>
                    <input type="text" class="form-control" value="default123" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleSelectRounded0">Role <span class="text-danger">*</span></label>
                    <select class="custom-select @error('role') is-invalid @enderror" name="role" id="role">
                      <option value="">Select Role</option>
                      @foreach($roles as $role)
                      <option>{{$role['name']}}</option>
                      @endforeach
                    </select>
                    @error('role')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block mb-3">REGISTER NOW</button>
              </div>
            </div>
          </form>
        </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection