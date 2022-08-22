@extends('layouts.guest')

@section('title',"Password Reset Link")
@section('content')
<div class="login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ route('login') }}"><b>LOGIN SYSTEM</b></a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <h2 class="reset-box-msg text-center text-primary">Password Reset</h2>
            @if (session('status'))
                <div class="bg-success text-center text-white py-2 mb-3">
                    {{ session('status') }}
                </div>
            @endif
      <form action="{{ route('reset-password') }}" method="post">
        @csrf
        <input type="hidden" name="udata" value="{{Request::segment(2)}}">
        <label for="newpass">New Password</label>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="*********" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
            @error('password')
                <span class="error invalid-feedback"> {{ $message }}</span>
            @enderror
        </div>
        <label for="cnnewpass">Confirm New Password</label>
        <div class="input-group mb-3">
          <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="********" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
            @error('password_confirmation')
                <span class="error invalid-feedback"> {{ $message }}</span>
            @enderror
        </div>
        <div class="row">
          <div class="col-12 mb-2">
            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.reset-card-body -->
  </div>
</div>
<!-- /.reset-box -->
</div>
@endsection