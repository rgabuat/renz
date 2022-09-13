@extends('layouts.app')

@section('title',"Domain Import Preview")
@section('content')
<div class="py-3">
    <div class="col-lg-12">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <h2 class="login-box-msg text-left text-primary px-0"><b>Preview Import Accounts</b></h2>
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
                    </tr>
                  @endforeach
              </tbody>
            </table>
            <form action="/domain/import" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  @foreach($param['users'] as $user)
                      <input type="hidden" name="domain[]" value="{{ $user[0] }}" >
                      <input type="hidden" name="country[]" value="{{ $user[1] }}">
                      <input type="hidden" name="domain_rating[]" value="{{ $user[2] }}">
                      <input type="hidden" name="traffic[]" value="{{ $user[3] }}">
                      <input type="hidden" name="ref_domain[]" value="{{ $user[4] }}">
                      <input type="hidden" name="token_cost[]" value="{{ $user[5] }}">
                      <input type="hidden" name="remarks[]" value="{{ $user[6] }}">
                      <input type="hidden" name="last_updated[]" value="{{ $user[7] }}">
                  @endforeach
              </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block mb-3">LOAD FILE</button>
              </div>
            </div>
          </form>
        </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection