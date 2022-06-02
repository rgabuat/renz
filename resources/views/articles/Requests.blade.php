@extends('layouts.app')

@section('title',"Article Orders")
@section('content')
<div class="table-responsive-sm py-3">
<div class="card">
    <div class="card-body">
        <h2 class="text-primary"><b>Article Requests</b></h2>
        @if (session('status'))
            <div class="bg-success text-center text-white py-2 mb-3">
                {{ session('status') }}
            </div>
        @endif
        <table class="table" id="article_tbl">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Account name</th>
                <th>Company</th>
                <th>Type</th>
                <th>Offer</th>
                <th>Url</th>
                <th>Publishing date</th>
                <th>Created At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <td><span>{{ $request['id'] }}</span></td>
                <td><span>{{ $request['user'][0]['username'] }}</span></td>
                <td><span>{{ $request['company'][0]['company_name'] }}</span></td>
                <td><span>{{ $request['type'] }}</span></td>
                <td><span>{{ $request['offer'] }}</span></td>
                <td><span>{{ $request['url'] }}</span></td>
                <td><span>{{ $request['publishing_date'] }} </span></td>
                <td><span>{{ $request['created_at'] }} </span></td>
                <td><span class="badge {{ $request['status'] == 'pending' ? 'badge-warning' : (($request['status'] == 'processing') ? 'badge-primary' : 'badge-success') }}">{{ $request['status'] }} </span></td>
                <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                    <span class="fas fa-align-right"></span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                            @role('system admin|system editor')
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#approve{{ $request['id'] }}"><span class="fas fa-check mr-2"></span>Approve Request</a>
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#decline{{ $request['id'] }}"><span class="fas fa-times mr-2"></span>Decline Request</a>
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#publish{{ $request['id'] }}"><span class="fas fa-newspaper mr-2"></span>Publish Article</a>
                            @endrole
                    </div>
                </div>
                </td>
            </tr>
        
            <!-- aprrove request Modal -->
            <div class="modal fade" id="approve{{ $request['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="approve">Approve Article Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            <form action="{{ url('article/order/'.$request['id'].'/approve') }}" method="post">
                                @csrf
                                <p>Approve article request from: <span><b>{{ $request['company_name'] }}</b></span></p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="APPROVE">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- decline request Modal -->
            <div class="modal fade" id="decline{{ $request['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="decline">Decline Article Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('article/order/'.$request['id'].'/decline') }}" method="post">
                                @csrf
                                <p>Decline article request from: <span><b>{{ $request['company_name'] }}</b></span></p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-danger" value="DECLINE">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- publish article Modal -->
            <div class="modal fade" id="decline{{ $request['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="decline">Publish Article Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('article/order/'.$request['id'].'/publish') }}" method="post">
                                @csrf
                                <p>Publish article request from: <span><b>{{ $request['company_name'] }}</b></span></p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-danger" value="PUBLISH">
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
