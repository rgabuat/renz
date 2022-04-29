@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="col-lg-8 pt-5">
      <div class="card">
        <div class="card-body ">
          <p class="login-box-msg">Change Password</p>
            @if (session('status'))
                <div class="bg-success text-center text-white py-2 mb-3">
                    {{ session('status') }}
                </div>
            @endif
          <form action="{{ route('changePassword') }}" method="post">
              @csrf
            <div class="col-lg-12">
                <label for="current-password">Current Password</label>
                <div class="input-group mb-3">
                  <input type="password" name="current-password" class="form-control @error('current-password') is-invalid @enderror" placeholder="******">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                    @error('current-password')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-lg-12">
              <label for="new-password">New Password</label>
                <div class="input-group mb-3">
                  <input type="password" name="new-password" class="form-control @error('new-password') is-invalid @enderror" placeholder="******">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                    @error('new-password')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-lg-12">
              <label for="new-password_confirmation">Confirm New Password</label>
                <div class="input-group mb-3">
                  <input type="password" name="new-password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="******">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                    @error('new-password_confirmation')
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
        </div>
      </div>
  </div>
</div>
<!-- /.login-box -->
@endsection