@extends('layouts.guest')

@section('title',"Login")
@section('content')
<div class="login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <div class="login-logo">
        <h1><a href="{{ route('login') }}"><b>Link Building System</b></a></h1>
      </div>
      <h3 class="login-box-msg text-center text-primary">Sign in</h3>
            @if (session('status'))
                <div class="bg-danger text-center text-white py-2 mb-3">
                    {{ session('status') }}
                </div>
            @endif
      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="userlogin" class="form-control @error('userlogin') is-invalid @enderror" value="{{ old('userlogin') }}" placeholder="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
            @error('userlogin')
                <span class="error invalid-feedback"> {{ $message }}</span>
            @enderror
        </div>
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
        <div class="row">
          <div class="col-12 mb-2">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
      <p class="mb-0 text-center">
        <a href="{{ route('forgot-password') }}">Forgot Password</a>
      </p>
      <p class="mb-0 text-center">
        <a href="{{ route('register') }}">Create Account</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection