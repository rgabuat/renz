@extends('layouts.guest')

@section('title',"forgot-password")
@section('content')
<div class="login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ route('login') }}"><b>LOGIN SYSTEM</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <h2 class="login-box-msg text-center text-primary">Reset Password</h2>
            @if (session('status'))
                <div class="bg-success text-center text-white py-2 mb-3">
                    {{ session('status') }}
                </div>
            @endif
      <form action="{{ route('send-forgot-password') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" required>
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
          <div class="col-12 mb-2">
            <button type="submit" class="btn btn-primary btn-block">Send Password Link</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection