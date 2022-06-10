@extends('layouts.app')

@section('title',"Company Details")
@section('content')

<div class="py-3">
    <div class="col-lg-6">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <h2 class="login-box-msg  text-left text-primary px-0"><b>Company Details</b></h2>
            <p>Company Name: <span class="font-weight-bold">{{ $compDetails[0]['company_name'] }}</span></p>
            <p>Registered Number: <span class="font-weight-bold">{{ $compDetails[0]['reg_number'] }}</span></p>
            <p>Status: <span class="font-weight-bold">{{ $compDetails[0]['status'] }}</span></p>
            <p>City: <span class="font-weight-bold">{{ $compDetails[0]['city'] }}</span></p>
            <p>State: <span class="font-weight-bold">{{ $compDetails[0]['state'] }}</span></p>
            <p>Country: <span class="font-weight-bold">{{ $compDetails[0]['country'] }}</span></p>
            <p>Zip: <span class="font-weight-bold">{{ $compDetails[0]['zip'] }}</span></p>
        </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection