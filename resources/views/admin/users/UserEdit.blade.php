@extends('layouts.app')


@section('content')
<div class="">
    <div class="col-lg-8">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <p class="login-box-msg h2 text-left px-0">Edit User {{ $user->id }}</p>
                @if (session('status'))
                    <div class="bg-success text-center text-white py-2 mb-3">
                        {{ session('status') }}
                    </div>
                @endif
          <form action="{{ url('users/update/'.$user->id) }}" method="post">
              @csrf
            <div class="input-group mb-3">
              <input type="text" name="company" class="form-control @error('company') is-invalid @enderror" value="{{ $user->company }}" placeholder="Company">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="far fa-building"></span>
                </div>
              </div>
                @error('company')
                    <span class="error invalid-feedback"> {{ $message }}</span>
                @enderror
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ $user->first_name }}" placeholder="Firstname">
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
                  <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ $user->last_name }}" placeholder="Lastname">
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
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $user->address }}" placeholder="Address">
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
                    <input type="tel" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $user->phone_number }}" placeholder="Phone Number">
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
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ $user->username }}" placeholder="Username">
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
                    <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" placeholder="Email">
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
            </div>
            <div class="form-group">
                <label for="exampleSelectRounded0">Role</label>
                <select class="custom-select" name="role" id="role">
                  <option value="">Select Role</option>
                  @foreach($roles as $role)
                    <option value="{{$role['name']}}" {{ ($user->roles[0]->name == $role['name']) ? 'selected' : '' }}>{{$role['name']}}</option>
                  @endforeach
                </select>
              </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block mb-3">UPDATE PROFILE</button>
              </div>
            </div>
          </form>
        </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection