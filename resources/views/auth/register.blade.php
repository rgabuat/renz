@extends('layouts.guest')


@section('content')
<div class="login-page">
  <div class="container">
    <div class="col-lg-8 m-auto">
      <div class="login-logo">
        <a href="../../index2.html"><b>LOGIN SYSTEM</b></a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <p class="login-box-msg">Register Now</p>
                @if (session('error'))
                    <div class="bg-danger text-center text-white py-2 mb-3">
                        {{ session('error') }}
                    </div>
                @elseif(session('success'))
                  <div class="bg-success text-center text-white py-2 mb-3">
                        {{ session('success') }}
                    </div>
                @endif
          <form action="{{ route('register') }}" method="post">
              @csrf
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
            <div class="row">
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" placeholder="Firstname">
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
                  <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" placeholder="Lastname">
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
            <div class="row">
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <input type="tel" name="reg_number" class="form-control @error('reg_number') is-invalid @enderror" value="{{ old('reg_number') }}" placeholder="Registered Number">
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
            <div class="row">
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
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                    @error('password_confirmation')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
            </div>
            <div>
              <label for="captcha">Answer this question</label>
              @php
                  $randNum1 = mt_rand(1,20);
                  $randNum2 = mt_rand(1, 20);
                  $sum = $randNum1 - $randNum2;
              @endphp
                <input type="hidden" name="captchaResult" value="{{ md5($sum) }}">
              <div class="row">
                <div class="col-lg-3">
                  <h5> Answer : {{ $randNum1 }} - {{ $randNum2 }} =</h5>
                </div>
                <div class="col-lg-9">
                  <div class="form-group">
                    <input type="tel" name="captcha" class="form-control @error('captcha') is-invalid @enderror" value="" size="2"> 
                  </div>
                </div>
              </div>
                @error('captcha')
                    <span class="error invalid-feedback"> {{ $message }}</span>
                @enderror
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block mb-3">REGISTER NOW</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <!-- /.social-auth-links -->

          <p class="mb-1 text-center">
            <a href="forgot-password.html">I forgot my password</a>
          </p>
          <p class="mb-0 text-center  ">
            <a href="register.html" class="text-center">Login now</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection