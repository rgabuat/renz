@extends('layouts.app')


@section('content')
<div class="">
    <div class="col-lg-8">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <p class="login-box-msg h2 text-left px-0">Create Company Account</p>
                @if (session('status'))
                    <div class="bg-success text-center text-white py-2 mb-3">
                        {{ session('status') }}
                    </div>
                @endif
          <form action="{{ route('company/store') }}" method="post">
              @csrf
              <input type="hidden" name="comp_id" value="">
            @role('system admin|system editor')
            <div class="row">
            <div class="col-md-6">
              <div class="input-group mb-3">
                <input type="text" name="company" class="form-control @error('company') is-invalid @enderror" value="{{ old('company') }}" placeholder="Company">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="far fa-building"></span>
                  </div>
                </div>
                  @error('company')
                      <span class="error invalid-feedback"> {{ $message }}</span>
                  @enderror
              </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                  <input type="tel" name="reg_number" class="form-control @error('reg_number') is-invalid @enderror"  value="{{ old('reg_number') }}" placeholder="Registered Number">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-circle"></span>
                    </div>
                  </div>
                    @error('reg_number')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
            </div>
            @endrole
            <div class="row">
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}"  placeholder="Firstname">
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
                  <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}"  placeholder="Lastname">
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
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Address">
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
              <div class="col-lg-6">
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
              @role('system admin|system editor')
              
              @endrole
            </div>
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
            <p>Default Password : default123</p>
            <!-- <div class="row">
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="******">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                    @error('password')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="******">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-key"></span>
                    </div>
                  </div>
                    @error('password_confirmation')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div> 
            </div>-->
            <div class="form-group">
                <label for="exampleSelectRounded0">Role</label>
                <select class="custom-select @error('role') is-invalid @enderror" name="role" id="role" >
                  <option value="">Select Role</option>
                  @foreach($roles as $role)
                  <option>{{$role['name']}}</option>
                  @endforeach
                </select>
                @error('role')
                    <span class="error invalid-feedback"> {{ $message }}</span>
                @enderror
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