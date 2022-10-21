@extends('layouts.app')

@section('title','Company Details')
@section('content')

<div class="py-3">
    <div class="col-12">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <h2 class="login-box-msg  text-center text-primary px-0"><b>Company Details</b></h2>
            <div class="row">
              <div class="col-12">
              @if($compDetails->isNotEmpty()) 
                <div class="form-group">
                    <label for="company_name" class="form-label">Company Name:</label>
                    <input type="text" class="form-control" readonly value="{{ $compDetails[0]['company_name'] }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="company_reg_number" class="form-label">Vat Number</label>
                      <input type="text" class="form-control" readonly value="{{ $compDetails[0]['reg_number'] }}">
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="company_status" class="form-label">Status:</label>
                      <br>
                      <span class=" badge p-2 {{ $compDetails[0]['status'] != 'pending' ? 'badge-success' : 'badge-warning' }}">{{ $compDetails[0]['status']  }}</span>
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="company_city" class="form-label">City:</label>
                      <input type="text" class="form-control" readonly value="{{ $compDetails[0]['city'] }}">
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="company_state" class="form-label">State:</label>
                      <input type="text" class="form-control" readonly value="{{ $compDetails[0]['state'] }}">
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="company_country" class="form-label">Country:</label>
                      <input type="text" class="form-control" readonly value="{{ $compDetails[0]['country'] }}">
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="company_zip" class="form-label">Zip code:</label>
                      <input type="text" class="form-control" readonly value="{{ $compDetails[0]['zip'] }}">
                  </div>
              </div>
            </div>
            @else 
            <p class="text-center">No Details Found</p>
            @endif
        </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection