@extends('layouts.app')


@section('content')

<div class="">
    <div class="col-lg-8">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <p class="login-box-msg h2 text-left px-0">Edit Company {{ $company->id }}</p>
                @if (session('status'))
                    <div class="bg-success text-center text-white py-2 mb-3">
                        {{ session('status') }}
                    </div>
                @endif
          <form action="{{ url('company/update/'.$company->id) }}" method="post">
              @csrf
            <div class="row">
            <div class="col-md-6">
              <label for="comp_name">Company Name</label>
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
              <label for="vat_num">Registered Number</label>
                <div class="input-group mb-3">
                  <input type="text" name="reg_number" class="form-control @error('firstname') is-invalid @enderror" value="{{ $company->reg_number }}" placeholder="Firstname">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-company"></span>
                    </div>
                  </div>
                    @error('reg_num')
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
        </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection