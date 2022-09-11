@extends('layouts.app')

@section('title',"Company Modify")
@section('content')

<div class="py-3">
    <div class="col-lg-12">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <h2 class="login-box-msg  text-left text-primary px-0"><b>Edit Company Details</b></h2>
                @if (session('status'))
                    <div class="bg-success text-center text-white py-2 mb-3">
                        {{ session('status') }}
                    </div>
                @endif

          @if($company != '') 
          <form action="{{ url('company/update/'.$company->id) }}" method="post">
              @csrf
            <div class="row">
            <div class="col-md-6">
              <label for="comp_name">Company Name <span class="text-danger">*</span></label>
              <div class="input-group mb-3">
                <input type="text" name="company" class="form-control @error('company') is-invalid @enderror" value="{{ $company->company_name }}" placeholder="Company">
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
              <label for="vat_num">Registered Number <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                  <input type="text" name="reg_number" class="form-control @error('reg_number') is-invalid @enderror" value="{{ $company->reg_number }}" placeholder="Firstname">
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
              <label for="city">City <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                  <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ $company->city }}" placeholder="City">
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
                <label for="state">State <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                  <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ $company->state }}" placeholder="State">
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
                <label for="country">Country <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                  <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" value="{{ $company->country }}" placeholder="Country">
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
                <label for="zip">Zip code <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                  <input type="tel" name="zip" class="form-control @error('zip') is-invalid @enderror" value="{{ $company->zip }}" placeholder="Zip code">
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
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block mb-3">UPDATE COMPANY</button>
              </div>
            </div>
          </form>
          @else 
            <p class="text-center">No Details Found</p>
          @endif
        </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection