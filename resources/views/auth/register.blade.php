@extends('layouts.guest')
@section('title',"Register")
@section('content')
<div class="page">
  <div class="container">
    <div class="col-lg-8 m-auto">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
        <div class="login-logo">
          <h1><a href="{{ route('login') }}"><b>Link Building System</b></a></h1>
        </div>
          <h3 class="login-box-msg text-center text-primary px-0"><b>Create Account</b></h3>
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
              <label for="company">Company <span class="text-danger">*</span> </label>
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
              <label for="firstname">Firstname <span class="text-danger">*</span> </label>
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
              <label for="lastname">Lastname <span class="text-danger">*</span> </label>
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
            <label for="address">Address <span class="text-danger">*</span> </label>
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
              <label for="city">City<span class="text-danger">*</span> </label>
                <div class="input-group mb-3">
                  <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" placeholder="City">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-city"></span>
                    </div>
                  </div>
                    @error('city')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <label for="state">State<span class="text-danger">*</span> </label>
                <div class="input-group mb-3">
                  <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state') }}" placeholder="State">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-landmark"></span>
                    </div>
                  </div>
                    @error('state')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <label for="country">Country<span class="text-danger">*</span> </label>
                <!-- All countries -->
                <select id="country" class="form-control @error('country') is-invalid @enderror">
                    <option>country</option>
                    @foreach($countries as $country)
                      <option value="{{$country->code}}">{{$country->country_name}}</option>
                    @endforeach
                </select>
                  @error('country')
                      <span class="error invalid-feedback"> {{ $message }}</span>
                  @enderror
              </div>
              <div class="col-lg-6">
                <label for="zip">Zip code<span class="text-danger">*</span> </label>
                <div class="input-group mb-3">
                  <input type="tel" name="zip" class="form-control @error('zip') is-invalid @enderror" value="{{ old('zip') }}" placeholder="Zip code">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-map-pin"></span>
                    </div>
                  </div>
                    @error('zip')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6">
              <label for="reg_number">VAT Number <span class="text-danger">*</span> </label>
                <div class="input-group mb-3">
                  <input type="tel" name="reg_number" class="form-control @error('reg_number') is-invalid @enderror" value="{{ old('reg_number') }}" placeholder="Registered/VAT Number">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-credit-card"></span>
                    </div>
                  </div>
                    @error('reg_number')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-lg-6">
              <label for="phone_number">Phone number<span class="text-danger">*</span> </label>
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
            <label for="username">Username<span class="text-danger">*</span> </label>
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
            <label for="email">Email<span class="text-danger">*</span> </label>
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
              <label for="password">Password<span class="text-danger">*</span> </label>
                <div class="input-group mb-3">
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
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
              <label for="password_confirmation">Confirm password<span class="text-danger">*</span> </label>
                <div class="input-group mb-3">
                  <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm password">
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
              <label for="captcha">Answer this question <span class="text-danger"> *</span></label>
              @php
                  $randNum1 = mt_rand(1,20);
                  $randNum2 = mt_rand(1, 20);
                  $sum = $randNum1 - $randNum2;
              @endphp
                <input type="hidden" name="captchaResult" value="{{ md5($sum) }}">
              <div class="row">
                <div class="col-lg-2">
                  <h5>{{ $randNum1 }} - {{ $randNum2 }} =</h5>
                </div>
                <div class="col-lg-10">
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
                <button type="submit" class="btn btn-primary btn-block mb-3">Create Now</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <!-- /.social-auth-links -->

          <p class="mb-0 text-center  ">
            <a href="{{ route('login') }}" class="text-center">Already have an account? Go to Login</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection