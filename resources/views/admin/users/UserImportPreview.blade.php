@extends('layouts.app')


@section('content')
<div class="">
    <div class="col-lg-12">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <p class="login-box-msg h2 text-left px-0">Preview Import Accounts</p>
                @if (session('status'))
                    <div class="bg-success text-center text-white mb-3 py-2">
                        {{ session('status') }}
                    </div>
                @endif
            <table class="table">
              <thead>
                <tr>
                  @foreach($param['heading'] as $headings)
                    <th>{{ $headings }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                 
                  @foreach($param['users'] as $user)
                  <tr>
                    <td>{{ $user[0] }}</td>
                    <td>{{ $user[1] }}</td>
                    <td>{{ $user[2] }}</td>
                    <td>{{ $user[3] }}</td>
                    <td>{{ $user[4] }}</td>
                    <td>{{ $user[5] }}</td>
                    <td>{{ $user[6] }}</td>
                    <td>{{ $user[7] }}</td>
                    <td>{{ $user[8] }}</td>
                    <td>{{ $user[9] }}</td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
            <form action="/admin/users/import" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <input hidden type="text" value="{{ $param['location'] }}" name="file">
              </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block mb-3">IMPORT NOW</button>
              </div>
            </div>
          </form>
        </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection