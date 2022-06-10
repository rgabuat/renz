@extends('layouts.app')
@section('title',"Companies")
@section('content')
<div class="table-responsive-sm py-3">
<div class="card">
    <div class="card-body">
        <h2 class="text-left text-primary"><b>Company</b></h2>
        <table class="table" @role('system admin|system editor|system user') id="company_tbl_search" @endrole @role('company admin|company user') id="company_tbl" @endrole" >
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Company</th>
                    <th>Reg No.</th>
                    <th>Creator</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                <tr>
                    <td>{{ $company['id']}}</td>
                    <td>{{ $company['company_name']}}</td>
                    <td>{{ $company['reg_number']}}</td>
                        <td> 
                            @role('system admin|system editor|company admin')
                                @if(!empty($company['admin_sub_accounts'][0])) 
                                    {{ $company['admin_sub_accounts'][0]['first_name']}}
                                @endif
                                @role('company user|system admin|system editor')
                                    @if(!empty($company['user_sub_accounts'][0])) 
                                        {{ $company['user_sub_accounts'][0]['first_name']}}
                                    @endif
                                @endrole
                            @endrole
                        </td>
                    <td>{{ $company['created_at']}}</td>
                    <td>{{ $company['updated_at']}}</td>
                    <td>{{ $company['status']}}</td>
                    <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                        <span class="fas fa-align-right"></span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                            <a class="dropdown-item" href="{{ url('company/'.$company['id'].'/details')}}"><span class="fas fa-eye mr-2"></span>View company</a>
                            @role('system admin|system editor|company admin')
                                <a class="dropdown-item" href="{{ url('company/edit/'.$company['id'])}}"><span class="fas fa-pen mr-2"></span>Edit company</a>
                            @endrole
                                <a class="dropdown-item" href="{{ url('company/'.$company['company_name'].'/users/'.$company['id'])}}"><span class="fas fa-users mr-2"></span>View Users</a>
                            @role('system admin')
                                @if($company['is_activated'])
                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#deactivate{{ $company['id'] }}"><span class="fas fa-eye-slash mr-2"></span>Deactivate company</a>
                                @else
                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#activate{{ $company['id'] }}"><span class="fas fa-eye mr-2"></span>Activate company</a>
                                @endif
                            @endrole
                        </div>
                    </div>
                    </td>
                </tr>
            
                <!-- deactivate Modal -->
                <div class="modal fade" id="deactivate{{ $company['id'] }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deactivateModal">Deactivate company</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            Deactivate Company
                            <div class="modal-body">
                                <form action="{{ url('company/deactivate/'.$company['id']) }}" method="post">
                                    @csrf
                                    <input type="submit" class="btn btn-danger" value="Deactivate company">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- activate Modal -->
                <div class="modal fade" id="activate{{ $company['id'] }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="activateModal">Deactivate company</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            Deactivate Company
                            <div class="modal-body">
                                <form action="{{ url('company/activate/'.$company['id']) }}" method="post">
                                    @csrf
                                    <input type="submit" class="btn btn-danger" value="Activate company">
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
<div>
@endsection
