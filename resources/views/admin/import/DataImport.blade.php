@extends('layouts.app')


@section('content')
<div class="">
    <div class="col-lg-8">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <p class="login-box-msg h2 text-left px-0">Import Domain Data</p>
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