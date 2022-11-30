@extends('layouts.app')

@section('title','Company Details')
@section('content')

<div class="py-3">
    <div class="col-12">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <h2 class="login-box-msg  text-center text-primary px-0"><b>Package Details</b></h2>
            <div class="row">
              <div class="col-12">
                @if(!is_null($package_details)) 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Package name</label>
                                <input type="text" class="form-control" readonly value="{{ $package_details['name'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="text" class="form-control" readonly value="Php {{ $package_details['amount'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="currency" class="form-label">Currency</label>
                                <input type="text" class="form-control" readonly value="{{ $package_details['currency'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="credits" class="form-label">Credits</label>
                                <input type="text" class="form-control" readonly value="{{ $package_details['credits'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="payment_method" class="form-label">Payment method</label>
                                <input type="text" class="form-control" readonly value="{{ $package_details['payment_method'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duration" class="form-label">Duration</label>
                                <input type="text" class="form-control" readonly value="{{ $package_details['interval_count'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duration" class="form-label">Date created</label>
                                <input type="text" class="form-control" readonly value="{{ $package_details['created_at'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duration" class="form-label">Date Updated</label>
                                <input type="text" class="form-control" readonly value="{{ $package_details['updated_at'] }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                {{ $package_details['description'] }}
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