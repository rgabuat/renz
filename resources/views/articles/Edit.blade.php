@extends('layouts.app')

@section('title',"Article Edit")
@section('content')
<div class="py-3">
<form action="{{ url('article/update/'.$article[0]['id']) }}" method="post" enctype="multipart/form-data">
@csrf
  <div class="row">
    <div class="col-lg-8">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body ">
            <h2 class="login-box-msg h2 text-left text-primary px-0"><b>Edit Article {{$article[0]['title']}}</b></h2>
                @if (session('status'))
                    <div class="bg-success text-center text-white py-2 mb-3">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $article[0]['title'] }}"  placeholder="Article Title">
                    @error('title')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Url <span class="text-danger">*</span></label>
                    <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ $article[0]['url'] }}"  placeholder="Article url">
                    @error('url')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{ $article[0]['body'] }}</textarea>
                    @error('body')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="category">Category <span class="text-danger">*</span></label>
                    <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ $article[0]['categories'] }}"  placeholder="Article Category">
                    @error('category')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="author">Author <span class="text-danger">*</span></label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ $article[0]['author'] }}"  placeholder="Author">
                    @error('author')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary form-control my-1" value="Update Article" >
                    <a href="javascript:void(0);"  class="btn btn-danger form-control my-1" data-toggle="modal" data-target="#cancel{{ $article[0]['id'] }}" >Cancel</a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="category">Featured image </label>
                    <div class="col-lg-12 py-2">
                        <img src="{{ $article[0]['featured_image'] != NULL ? asset('storage/'.$article[0]['featured_image']) : '/vendors/dist/img/AdminLTELogo.png' }}" alt="{{ $article[0]['title'] }}_featured_image" class="img-fluid">
                    </div>
                    <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror">
                    @error('featured_image')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- cancel edit post Modal -->
    <div class="modal fade" id="cancel{{ $article[0]['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="Delete">Cancel Edit Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to Cancel edit?</p>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <a href="{{ url('article/view/'.$article[0]['id']) }}" class="btn btn-success">Confirm</a>
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