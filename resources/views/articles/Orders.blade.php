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
                <th>Completed At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td><span>{{ $order['id'] }}</span></td>
                <td><span>{{ $order['user'][0]['username'] }}</span></td>
                <td><span>{{ $order['company'][0]['company_name'] }}</span></td>
                <td><span>{{ $order['type'] }}</span></td>
                <td><span>{{ $order['offer'] }}</span></td>
                <td><span>{{ $order['url'] }}</span></td>
                <td><span>{{ $order['publishing_date'] }} </span></td>
                <td><span>{{ $order['created_at'] }} </span></td>
                <td><span>{{ $order['completed_at'] }} </span></td>
                <td><span class="badge {{ $order['status'] == 'pending' ? 'badge-warning' : (($order['status'] == 'processing') ? 'badge-primary' : 'badge-success') }}">{{ $order['status'] }} </span></td>
                <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                    <span class="fas fa-align-right"></span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                            @role('system admin|system editor')
                                @if($order['status'] == 'pending')
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#approve{{ $order['id'] }}"><span class="fas fa-check mr-2"></span>Approve Request</a>
                                @elseif($order['status'] != 'processing' && $order['status'] != 'completed')
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#decline{{ $order['id'] }}"><span class="fas fa-times mr-2"></span>Decline Request</a>
                                @elseif($order['status'] == 'processing')
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#publish{{ $order['id'] }}"><span class="fas fa-newspaper mr-2"></span>Publish Article</a>
                                @endif
                            @endrole
                            @role('company admin|company user')
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#view{{ $order['id'] }}"><span class="fas fa-eye mr-2"></span>View Order</a>
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#edit{{ $order['id'] }}"><span class="fas fa-pen mr-2"></span>Edit Order</a>
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#delete{{ $order['id'] }}"><span class="fas fa-trash mr-2"></span>Delete Order</a>
                            @endrole
                    </div>
                </div>
                </td>
            </tr>


            @role('company admin|company user')
            <!-- edit order Modal -->
            <div class="modal fade" id="edit{{ $order['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit">Approve Article Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('article/order/'.$order['id'].'/approve') }}" method="post">
                                @csrf
                                <p>Edit article  <span><b>{{ $order['company_name'] }}</b></span></p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="UPDATE">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- delete order Modal -->
            <div class="modal fade" id="delete{{ $order['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete">Approve Article Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('article/order/'.$order['id'].'/approve') }}" method="post">
                                @csrf
                                <p>Edit article  <span><b>{{ $order['company_name'] }}</b></span></p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-danger" value="DELETE">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endrole

        
            @role('system admin|system editor|system user')
<!-- aprrove request Modal -->
<div class="modal fade" id="approve{{ $order['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="approve">Approve Article Request</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('article/order/'.$order['id'].'/approve') }}" method="post">
                                @csrf
                                <p>Approve article request from: <span><b>{{ $order['company_name'] }}</b></span></p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="APPROVE">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- publish article Modal -->
            <div class="modal fade" id="publish{{ $order['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="publish">Publish Article Order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('article/order/'.$order['id'].'/publish') }}" method="post">
                                @csrf
                                <p>Publish article request from: <span><b>{{ $order['company'][0]['company_name'] }}</b></span></p>
                                <div class="form-group">
                                    <label for="url">Url for this Article <span class="text-danger">*</span></label>
                                    <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ $order['url'] != 'null' ? $order['url'] : 'insert url' }}">
                                    @error('url')
                                        <span class="error invalid-feedback"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-success" value="PUBLISH">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @endforeach
        </tbody>
    </table>
    </div>
</div>
</div>
@endsection
