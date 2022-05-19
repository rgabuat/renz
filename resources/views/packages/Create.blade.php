@extends('layouts.app')

@section('title',"Package Create")
@section('content')
    <div class="col-lg-6 py-3">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <h2 class="login-box-msg h2 text-left text-primary px-0"><b>Create Package</b></h2>
                @if (session('status'))
                    <div class="bg-success text-center text-white py-2 mb-3">
                        {{ session('status') }}
                    </div>
                @endif
          <form action="{{ route('package/store') }}" method="post">
              @csrf
            <div class="col-md-12">
                <label for="name">Package name <span class="text-danger">*</span> </label>
                <div class="form-group ">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" >
                    @error('name')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <label for="price">Price<span class="text-danger">*</span> </label>
                <div class="form-group ">
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" >
                    @error('price')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group ">
                    <label for="desecription">Description</label>
                    <textarea name="description" id=""  cols="30" rows="5" class="form-control @error('description') is-invalid @enderror"></textarea>
                </div>
                @error('description')
                    <span class="error invalid-feedback"> {{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="credits">Credits<span class="text-danger">*</span> </label>
                <div class="form-group ">
                    <input type="number" name="credits" class="form-control @error('credits') is-invalid @enderror" value="{{ old('credits') }}" >
                    @error('credits')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <label for="payment_method">Payment method<span class="text-danger">*</span> </label>
                <div class="form-group ">
                    <select name="payment_method" id="payment_method" class="form-control @error('payment_method') is-invalid @enderror">
                        <option value="">Select Payment method</option>
                        <option value="credit card">Credit Card</option>
                        <option value="invoice">invoice</option>
                    </select>
                    @error('payment_method')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <label for="duration">Duration<span class="text-danger">*</span> </label>
                <div class="form-group ">
                    <select name="duration" id="payment_method" class="form-control @error('duration') is-invalid @enderror">
                        <option value="">Select Duration</option>
                        <option value="1">1 Month</option>
                        <option value="3">3 Months</option>
                        <option value="6">6 Months</option>
                        <option value="12">12 Months</option>
                        <option value="24">24 Months</option>
                    </select>
                    @error('duration')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block mb-3">CREATE PACKAGE</button>
              </div>
          </form>
        </div>
  </div>
<!-- /.login-box -->
</div>
@endsection