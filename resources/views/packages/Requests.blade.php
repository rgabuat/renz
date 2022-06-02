@extends('layouts.app')

@section('title',"Users")
@section('content')
<div class="table-responsive-sm py-3">
<div class="card">
    <div class="card-body">
        <h2 class="text-primary"><b>Package Subscription Requests</b></h2>
        @if (session('status'))
            <div class="bg-success text-center text-white py-2 mb-3">
                {{ session('status') }}
            </div>
        @endif
        <table class="table" id="subs_table">
        <thead>
            <tr>
                <th>S/N</th>
                <th>User</th>
                <th>Company</th>
                <th>Credits</th>
                <th>Package</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <td><span>{{ $request['id'] }}</span></td>
                <td><span>{{ $request['user'][0]['first_name'] }} {{ $request['user'][0]['last_name'] }}</span></td>
                <td><span>{{ $request['user'][0]['company'][0]['company_name'] }}</span></td>
                <td><span>{{ $request['avail_credits']}}</span></td>
                <td><span>{{ $request['package'][0]['name']}}</span></td>
                <td><span>{{ Carbon\Carbon::parse($request['created_at'])->format('Y-m-d') }}</span></td>
                <td><span>{{ Carbon\Carbon::parse($request['updated_at'])->format('Y-m-d') }}</span></td>
                <td><span class="badge {{ $request['status'] == 0 ? 'badge-warning' : 'badge-success' }}">{{ $request['status'] == 0 ? 'Pending' : 'Active'}}</span></td>
                <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                    <span class="fas fa-align-right"></span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                        @if($request['status'] != 1)
                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#approve{{ $request['id'] }}"><span class="fas fa-check mr-2"></span>Approve Subscription</a>
                        @endif
                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#decline{{ $request['id'] }}"><span class="fas fa-times mr-2"></span>Decline Subscription</a>      
                    </div>
                </div>
                </td>
            </tr>
        
            <!-- edit post Modal -->
            <div class="modal fade" id="approve{{ $request['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit">Approve Subcription</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('package/approve/'.$request['id'].'/'.$request['user'][0]['company_id'] ) }}" method="post">
                                @csrf
                                <p>Approve Package Subscription</p>
                                <input type="hidden" name="package_id" value="{{ $request['package'][0]['id'] }}">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="UPDATE">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- decline post Modal -->
            <div class="modal fade" id="decline{{ $request['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="Delete">Decline Subscription</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('package/decline/'.$request['id']) }}" method="post">
                                @csrf
                                <p>Decline Package Subscription<span><b></b></span></p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-danger" value="DELETE">
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
