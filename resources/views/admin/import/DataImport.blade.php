@extends('layouts.app')

@section('title',"Domain Import")
@section('content')
<div class="py-3">
    <div class="col-lg-8">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <h2 class="login-box-msg text-left text-primary px-0"><b>Import Domain Data</b></h2>
                @if (session('status'))
                    <div class="bg-success text-center text-white mb-3 py-2">
                        {{ session('status') }}
                    </div>
                @endif
          <form action="/domain/parse_import" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <input type="file" name="file">
              </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block mb-3">IMPORT NOW</button>
              </div>
              <!-- /.col -->
            </div>
          </form> 
          <!-- /.social-auth-links -->
        </div>
        <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection