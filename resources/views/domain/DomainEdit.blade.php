@extends('layouts.app')


@section('content')
    <div class="col-lg-6 py-3">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <p class="login-box-msg h2 text-left px-0">Create New Domain</p>
                @if (session('status'))
                    <div class="bg-success text-center text-white py-2 mb-3">
                        {{ session('status') }}
                    </div>
                @endif
          <form action="{{ url('domain/update/'.$domain['id']) }}" method="post">
              @csrf
            <div class="col-md-12">
                <label for="domain">Domain name <span class="text-danger">*</span> </label>
                <div class="input-group mb-3">
                    <input type="text" name="domain" class="form-control @error('domain') is-invalid @enderror" value="{{ $domain['domain'] }}" >
                    <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-globe"></span>
                    </div>
                    </div>
                    @error('domain')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
              <div class="col-md-12">
                <label for="country">Country<span class="text-danger">*</span> </label>
                <div class="input-group mb-3">
                    <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" value="{{ $domain['country'] }}" >
                    <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-globe"></span>
                    </div>
                    </div>
                    @error('country')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-md-12">
                <label for="domain_rating">Domain Rating<span class="text-danger">*</span> </label>
                <div class="input-group mb-3">
                    <input type="text" name="domain_rating" class="form-control @error('domain_rating') is-invalid @enderror" value="{{ $domain['domain_rating'] }}" >
                    <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-globe"></span>
                    </div>
                    </div>
                    @error('country')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-md-12">
                <label for="traffic">Traffic<span class="text-danger">*</span> </label>
                <div class="input-group mb-3">
                    <input type="text" name="traffic" class="form-control @error('traffic') is-invalid @enderror" value="{{ $domain['traffic'] }}" >
                    <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-globe"></span>
                    </div>
                    </div>
                    @error('traffic')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-md-12">
                <label for="ref_domain">Reference Domain </label>
                <div class="input-group mb-3">
                    <input type="text" name="ref_domain" class="form-control @error('ref_domain') is-invalid @enderror" value="{{ $domain['ref_domain'] }}" >
                    <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-globe"></span>
                    </div>
                    </div>
                    @error('ref_domain')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-md-12">
                <label for="token_cost">Token cost<span class="text-danger">*</span> </label>
                <div class="input-group mb-3">
                    <input type="text" name="token_cost" class="form-control @error('token_cost') is-invalid @enderror" value="{{ $domain['token_cost'] }}" >
                    <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-globe"></span>
                    </div>
                    </div>
                    @error('token_cost')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
              </div>
              <div class="col-md-12 mb-3">
                <label for="remarks">Remarks</label>
                <textarea name="remarks" class="form-control" id="remarks" cols="30" value="" rows="10">{{ $domain['remarks'] }}</textarea>
                @error('remarks')
                    <span class="error invalid-feedback"> {{ $message }}</span>
                 @enderror
              </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block mb-3">UPDATE DOMAIN</button>
              </div>
            </div>
          </form>
        </div>
  </div>
<!-- /.login-box -->
</div>
@endsection