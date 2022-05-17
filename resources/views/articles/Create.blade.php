@extends('layouts.app')

@section('title',"Article Create")
@section('content')
<div class="py-3">
<form action="{{ route('article/store') }}" method="post" enctype="multipart/form-data">
@csrf
  <div class="row">
    <div class="col-lg-8">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body ">
            <h2 class="login-box-msg h2 text-left text-primary px-0"><b>Create Article </b></h2>
                @if (session('status'))
                    <div class="bg-success text-center text-white py-2 mb-3">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"  placeholder="Article Title">
                    @error('title')
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
                    <label for="body">Body</label>
                    <textarea name="body" id="tinymce" cols="30" rows="10" class="form-control">{{ old('body') }}</textarea>
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
                    <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}"  placeholder="Article Category">
                    @error('category')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="author">Author <span class="text-danger">*</span></label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}"  placeholder="Author">
                    @error('author')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary form-control" value="Publish Article" >
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="featured_image">Featured image </label>
                    <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror">
                    @error('featured_image')
                        <span class="error invalid-feedback"> {{ $message }}</span>
                    @enderror
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