@extends('layouts.app')
@section('title',"Company Show Sub User")
@section('content')

<div class="py-3">
    <div class="col-lg-12">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <div class="row">
            <div class="col-lg-6">
                <h2 class="login-box-msg text-left text-primary px-0"><b>{{ $user->username }} Details</b></h2>
            </div>
            <div class="col-lg-6 text-right">
                <a href="{{ url('company/edit/user/'.$user['id'])}}" class="btn btn-primary rounded-0"><span class="fas fa-pen mr-2"></span>Edit User</a>
            </div>
          </div>
            @if (session('status'))
                <div class="bg-success text-center text-white py-2 mb-3">
                    {{ session('status') }}
                </div>
            @endif
          <form action="{{ url('users/update/'.$user->id) }}" method="post">
              @csrf
            <div class="row">
              <div class="col-lg-6">
              <label for="firstname">Firstname<span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                  <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ $user->first_name }}" placeholder="Firstname" readonly>
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
              <label for="lastname">Lastname<span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                  <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ $user->last_name }}" placeholder="Lastname" readonly>
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
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $user->address }}" placeholder="Address" readonly>
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
            </div>
            <div class="row">
              <div class="col-md-6">
              <label for="username">Username <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                  <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ $user->username }}" placeholder="Username" readonly>
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
                <label for="email">Email<span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" placeholder="Email" readonly>
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
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                      <label for="exampleSelectRounded0">Role <span class="text-danger">*</span></label>
                      <select class="custom-select" name="role" id="role" required disabled>
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                          <option value="{{$role['name']}}" {{ ($user->role == $role['name']) ? 'selected' : '' }}>{{$role['name']}}</option>
                        @endforeach
                      </select>
                      @error('role')
                          <span class="error invalid-feedback"> {{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <label for="phone">Phone number<span class="text-danger">*</span></label>
                    <div class="input-group mb-3">
                      <input type="tel" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $user->phone_number }}" placeholder="Phone Number" readonly>
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
          </form>
        </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection