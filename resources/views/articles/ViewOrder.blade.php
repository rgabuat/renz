@extends('layouts.app')

@section('title',"Article View Order")
@section('content')
<div class="py-3">
  <div class="row">
    <div class="col-lg-12">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body ">
            <h2 class="login-box-msg h2 text-center text-primary px-0"><b>View Order</b></h2>
            <div class="form-group">
                <label for="company" class="label">Company :</label>
                <input type="text" class="form-control" value="test">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account_name" class="label">Account Name :</label>
                        <input type="text" class="form-control" value="test">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="offer" class="label">Offer :</label>
                        <input type="text" class="form-control" value="test">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="created_at" class="label">Created at :</label>
                        <input type="text" class="form-control" value="test">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="updated_at" class="label">Updated at :</label>
                        <input type="text" class="form-control" value="test">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="publish_date" class="label">Publishing  date :</label>
                        <input type="text" class="form-control" value="test">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="compleled_at" class="label">Completed at:</label>
                        <input type="text" class="form-control" value="test">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="heading" class="label">Heading :</label>
                <input type="text" class="form-control" value="test">
            </div>
        </div>
        </div>
    </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection