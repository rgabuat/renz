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
                <th>Offer</th>
                <th>Url</th>
                <th>Publishing date</th>
                <th>Created At</th>
                <th>Completed At</th>
                <th>Status</th>
                <th class="d-none">Actions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($completeorders as $completeorder)
            <tr>
                <td><span>{{ $completeorder['id'] }}</span></td>
                <td><span>{{ $completeorder['user'][0]['username'] }}</span></td>
                <td><span>{{ $completeorder['offer'] }}</span></td>
                <td><span>{!! !Empty($completeorder['domains'][0]) ? Str::limit($completeorder['domains'][0]['domain'],20, ' ...') : 'no url' !!}</span></td>
                <td><span>{{ $completeorder['publishing_date'] }} </span></td>
                <td><span>{{ Carbon\Carbon::parse($completeorder['created_at'])->format('Y-m-d') }} </span></td>
                <td><span>{{ Carbon\Carbon::parse($completeorder['completed_at'])->format('Y-m-d') }} </span></td>
                <td><span class="badge {{ $completeorder['status'] == 'pending' ? 'badge-warning' : (($completeorder['status'] == 'processing') ? 'badge-primary' : 'badge-success') }}">{{ $completeorder['status'] }} </span></td>
                <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                    <span class="fas fa-align-right"></span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#view{{ $completeorder['id'] }}"><span class="fas fa-eye mr-2"></span>View Order</a>
                    </div>
                </div>
                </td>

            </tr>

            <!-- view order Modal -->
            <div class="modal fade" id="view{{ $completeorder['id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header text-center align-items-center">
                            <div>
                                <h5 class="status btn-success p-2" id="delete"><strong>{{ $completeorder['status'] }}</strong></h5>
                            </div>
                            <div>
                                <h3 class="modal-title text-primary"><strong>View Order</strong></h3>
                            </div>
                            <div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="form-group">
                                    <label for="company" class="form-label">Company:</label>
                                    <input type="text" class="form-control" value="{{ $completeorder['company'][0]['company_name'] }}" disabled>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account" class="form-label">Account:</label>
                                            <input type="text" class="form-control" value="{{ $completeorder['user'][0]['first_name'].' '.$completeorder['user'][0]['last_name'] }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="offer" class="form-label">Offer:</label>
                                            <input type="text" class="form-control" value="{{ $completeorder['offer'] }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-none">
                                        <div class="form-group">
                                            <label for="domain_url" class="form-label">Domain url:</label>
                                            <input type="text" class="form-control" value="{{ !Empty($order['domains'][0]) ? $order['domains'][0]['domain'] : 'no url' }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="publish_date" class="form-label">Publishing date:</label>
                                            <input type="text" class="form-control" value="{{ $completeorder['publishing_date'] }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="created" class="form-label">Created At:</label>
                                            <input type="text" class="form-control" value="{{ $completeorder['created_at'] }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="updated" class="form-label">Updated At:</label>
                                            <input type="text" class="form-control" value="{{ $completeorder['updated_at'] }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="completed" class="form-label">Completed At:</label>
                                            <input type="text" class="form-control" value="{{ $completeorder['completed_at'] }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="heading" class="form-label">Heading:</label>
                                            <input type="text" class="form-control" value="{{ $completeorder['heading'] }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link_1" class="form-label">Url 1:</label>
                                            <input type="text" class="form-control" value="{{ $completeorder['link_url_1'] != '' ? $completeorder['link_url_1'] : 'null' }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="anchor_1" class="form-label">Anchor 1:</label>
                                            <input type="text" class="form-control" value="{{ $completeorder['anchor_1'] != '' ? $completeorder['anchor_1'] : 'null' }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link_2" class="form-label">Url 2:</label>
                                            <input type="text" class="form-control" value="{{ $completeorder['link_url_2'] != '' ? $completeorder['link_url_2'] : 'null' }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="anchor_2" class="form-label">Anchor 2:</label>
                                            <input type="text" class="form-control" value="{{ $completeorder['anchor_2'] != '' ? $completeorder['anchor_2'] : 'null' }}" disabled>
                                        </div>
                                    </div>
                                </div>
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
