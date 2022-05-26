@extends('layouts.app')

@section('title',"Article Order")
@section('content')
<div class="py-3">
<form action="{{ url('article/order/'.auth()->user()->id.'/'.auth()->user()->company_id) }}" method="post" enctype="multipart/form-data">
@csrf
  <div class="row">
    <div class="col-lg-4">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body ">
            <h2 class="login-box-msg h2 text-left text-primary px-0"><b>Order an Article </b></h2>
                @if (session('status'))
                    <div class="bg-success text-center text-white py-2 mb-3">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="type">Type <span class="text-danger">*</span></label>
                    <select name="type" id="type" class="form-control">
                        <option value="">Select type</option>
                        <option value="h1">H1</option>
                        <option value="anchor1">Anchor1</option>
                        <option value="link2">Link2</option>
                        <option value="anchor2">Anchor2</option>
                    </select>
                    @error('type')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="offer">Offer<span class="text-danger">*</span></label>
                    <select name="offer" id="offer" class="form-control">
                        <option value="">Select offer</option>
                        <option value="standard">Standard: 15 euro for 4 - 500 words</option>
                        <option value="premium">Premium: 30 euro for 750 words</option>
                    </select>
                    @error('offer')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Url <span class="text-danger">*</span></label>
                    <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url') }}"  placeholder="Article url">
                    @error('url')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="publish_date">Publishing date <span class="text-danger">*</span></label>
                    <input type="date" name="publish_date" class="form-control @error('publish_date') is-invalid @enderror" value="{{ old('publish_date') }}" >
                    @error('publish_date')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary form-control" value="Order now" >
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
</form>
<!-- /.login-box -->
</div>
@endsection