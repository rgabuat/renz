@extends('layouts.app')

@section('title',"Article Order")
@section('content')
<div class="py-3">
<form action="{{ url('article/order/'.auth()->user()->id.'/'.auth()->user()->company_id) }}" method="post" enctype="multipart/form-data">
@csrf
  <div class="row">
    <div class="col-12">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body ">
            <h2 class="login-box-msg h2 text-center text-primary px-0"><b>Order an Article </b></h2>
                @if (session('status'))
                    <div class="bg-success text-center text-white py-2 mb-3">
                        {{ session('status') }}
                    </div>
                @endif
                <input type="hidden" name="did" value="{{ Request::segment(2) }}">
                <div class="form-group">
                    <label for="heading">Heading<span class="text-danger">*</span></label>
                    <input type="text" name="heading" class="form-control @error('heading') is-invalid @enderror" value="{{ old('heading') }}"  placeholder="Heading">
                    @error('heading')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-12">
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
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="domain">Domain <span class="text-danger">*</span></label>
                            <input type="text" name="domain" class="form-control @error('domain') is-invalid @enderror" value="{{ $params[0]['domain'] != '' ? $params[0]['domain'] : '' }}"  readonly >
                            @error('domain')
                                <span class="error invalid-feedback"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="link1">Link Url 1 <span class="text-danger">*</span></label>
                            <input type="text" name="link_url_1" class="form-control @error('link_url_1') is-invalid @enderror" value="{{ old('link_url_1') }}"  placeholder="Link Url 1">
                            @error('link_url_1')
                                <span class="error invalid-feedback"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="link2">Link Url 2 </label>
                            <input type="text" name="link_url_2" class="form-control @error('link_url_2') is-invalid @enderror" value="{{ old('link_url_2') }}"  placeholder="Link Url 2">
                            @error('link_url_1')
                                <span class="error invalid-feedback"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="anchor1">Anchor Text 1<span class="text-danger">*</span></label>
                            <input type="text" name="anchor_1" class="form-control @error('anchor_1') is-invalid @enderror" value="{{ old('anchor_1') }}"  placeholder="Anchor 1">
                            @error('anchor_1')
                                <span class="error invalid-feedback"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="form-group">
                            <label for="anchor2">Anchor Text 2</label>
                            <input type="text" name="anchor_2" class="form-control @error('anchor_2') is-invalid @enderror" value="{{ old('anchor_2') }}"  placeholder="Anchor 2">
                            @error('anchor_2')
                                <span class="error invalid-feedback"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
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