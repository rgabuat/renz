@extends('layouts.app')

@section('title',"Article View")
@section('content')
<div class="py-3">
  <div class="row">
    <div class="col-lg-8">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body ">
            <h2 class="login-box-msg h2 text-left text-primary px-0">Article Title:<b>{{ $article[0]['title'] }}</b></h2>
            <p>Slug: <span><a href="{{ url('/'.$article[0]['url'] ) }}">{{ $article[0]['url'] }}</a></span></p>
            <img src="{{ $article[0]['featured_image'] != NULL ? asset('storage/'.$article[0]['featured_image']) : '/vendors/dist/img/AdminLTELogo.png' }}" alt="{{ $article[0]['title'] }}_featured_image" class="img-fluid" style="width: 400px;height:300px;object-fit: contain;">
            <article>
            <p>Post:{!! $article[0]['body'] !!}</p>
            </article>
            <p>Category:{{ $article[0]['categories'] }}</p>
            <p>Author:{{ $article[0]['author'] }}</p>
            <p>Status:{{ $article[0]['status'] }}</p>
        </div>
        </div>
    </div>
  </div>
</div>
<!-- /.login-box -->
</div>
@endsection