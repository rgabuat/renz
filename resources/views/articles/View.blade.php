@extends('layouts.app')

@section('title',"Article View")
@section('content')
<div class="py-3">
  <div class="row">
    <div class="col-lg-12">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body ">
            <h2 class="login-box-msg h2 text-left text-primary px-0"><b>{{ $article[0]['title'] }}</b></h2>
            <p><span><a href="{{ url('/'.$article[0]['url'] ) }}">{{ $article[0]['url'] }}</a></span></p>
            <div class="img-container text-center">
              <img src="{{ $article[0]['featured_image'] != NULL ? asset('storage/'.$article[0]['featured_image']) : '/vendors/dist/img/AdminLTELogo.png' }}" alt="{{ $article[0]['title'] }}_featured_image" class="img-fluid" style="width: 400px;height:300px;object-fit: contain;">
            </div>
            <article>
            <p>{!! $article[0]['body'] !!}</p>
            </article>
            <p>Category:<b class="pl-2">{{ $article[0]['categories'] }}</b></p>
            <p>Author:<b class="pl-2">{{ $article[0]['author'] }}</b></p>
            <p>Status:<b class="pl-2 "> <span class="badge {{ $article[0]['status'] == 'published' ? 'badge-success' : 'badge-warning' }}">{{ $article[0]['status'] }}</span></b></p>
        </div>
        </div>
    </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection