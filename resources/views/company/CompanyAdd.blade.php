@extends('layouts.app')

@section('title',"Company Create")
@section('content')
<div class="py-3">
    <div class="col-lg-12">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <h2 class="login-box-msg h2 text-center text-primary px-0"><b>Create Company Account</b></h2>
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
            <label for="company">Company <span class="text-danger">*</span></label>
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
            <label for="vat_num">Registered/VAT Number <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                  <input type="tel" name="reg_number" class="form-control @error('reg_number') is-invalid @enderror"  value="{{ old('reg_number') }}" placeholder="Registered/VAT Number">
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
              <label for="firstname">Firstname <span class="text-danger">*</span></label>
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
              <label for="lastname">Lastname <span class="text-danger">*</span></label>
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
              <label for="address">Address <span class="text-danger">*</span></label>
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
              @role('system admin|system editor')
              
              @endrole
            <!-- <div class="row">
              <div class="col-lg-6">
              <label for="city">City</label>
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
                <label for="state">State</label>
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
                <label for="country">Country</label>
                <div class="input-group mb-3">
                  <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" value="{{ old('country') }}" placeholder="Country">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-flag"></span>
                    </div>
                  </div>
                    @error('country')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <label for="zip">Zip code</label>
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
            </div> -->
            <div class="row">
              <div class="col-md-6 col-sm-12">
              <label for="username">Username <span class="text-danger">*</span></label>
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
              </div>
              <div class="col-md-6 col-sm-12">
                <label for="phone">Phone Number <span class="text-danger">*</span></label>
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
            
            <label for="email">Email <span class="text-danger">*</span></label>
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
              <div class="col-md-6 col-sm-12">
              <label for="default">Default password <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                  <input type="text" name="defaultpass" class="form-control @error('defaultpass') is-invalid @enderror" value="default123" readonly>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                    @error('email')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label for="exampleSelectRounded0">Role <span class="text-danger">*</span></label>
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
              </div>
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