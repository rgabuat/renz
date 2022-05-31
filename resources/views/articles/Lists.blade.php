@extends('layouts.app')

@section('title',"Articles")
@section('content')
<div class="table-responsive-sm py-3">
<div class="card">
    <div class="card-body">
        <h2 class="text-primary"><b>Articles</b></h2>
        @if (session('status'))
            <div class="bg-success text-center text-white py-2 mb-3">
                {{ session('status') }}
            </div>
        @endif
        <table class="table" id="article_tbl">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Featured Image</th>
                <th>Title</th>
                <th>Url</th>
                <th>Author</th>
                <th>Categories</th>
                <th>Status</th>
                <th>Publish Date</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td>{{ $article['id'] }}</td>
                <td><img src="{{ $article['featured_image'] != NULL ? asset('storage/'.$article['featured_image']) : '/vendors/dist/img/AdminLTELogo.png' }}" alt="{{ $article['title'] }}_featured_image" class="img-fluid" style="width: 80px;height:82px;object-fit: contain;"></td>
                <td>{{ $article['title'] }}</td>
                <td>{{ $article['url'] }}</td>
                <td>{{ $article['author'] }}</td>
                <td>{{ $article['categories'] }}</td>
                <td><span class="badge {{ $article['status'] == 'draft' ? 'badge-warning' : 'badge-success' }}">{{ $article['status'] }}</span></td>
                <td>{{ $article['publishing_date'] != 'null' ? $article['publishing_date'] : '--' }}</td>
                <td>{{ $article['created_at'] }}</td>
                <td>{{ $article['updated_at'] }}</td>
                <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                    <span class="fas fa-align-right"></span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#publish{{ $article['id'] }}"><span class="fas fa-newspaper mr-2"></span>Publish Article</a>
                            <a class="dropdown-item" href="{{ url('article/edit/'.$article['id'])}}"><span class="fas fa-pen mr-2"></span>Edit Post</a>
                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#delete{{ $article['id'] }}"><span class="fas fa-trash mr-2"></span>Delete Post</a>
                    </div>
                </div>
                </td>
            </tr>
        
            <!-- edit post Modal -->
            <div class="modal fade" id="edit{{ $article['id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit">Edit Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            <form action="{{ url('users/deactivate/') }}" method="post">
                                @csrf
                                
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="UPDATE">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- delete post Modal -->
            <div class="modal fade" id="delete{{ $article['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="Delete">Delete Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('article/delete/'.$article['id']) }}" method="post">
                                @csrf
                                <p>Are you sure you want to delete post: <span><b>{{ $article['title'] }}</b></span></p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-danger" value="DELETE">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- publish article Modal -->
            <div class="modal fade" id="publish{{ $article['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="publish">Publish Article Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('article/'.$article['id'].'/publish') }}" method="post">
                                @csrf
                                <p>Publish article: <span><b>{{ $article['title'] }}</b></span></p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-success" value="PUBLISH">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
</div>
@endsection
