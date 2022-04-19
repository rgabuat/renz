@extends('layouts.app')


@section('content')
<div class="login-page">
  <div class="container">
    <div class="col-lg-8 m-auto">
      <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <p class="login-box-msg">Register Now</p>
            @if (session('status'))
                <div class="bg-danger text-center text-white mb-3">
                    {{ session('status') }}
                </div>
            @endif
          <form action="{{ route('register') }}" method="post">
              @csrf
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
            <div class="row">
              <!-- /.col -->
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block mb-3">CHANGE PASSWORD</button>
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