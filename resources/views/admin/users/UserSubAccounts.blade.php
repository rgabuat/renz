@extends('layouts.app')
@section('title',"Company Sub Users")
@section('content')
<div class="table-responsive-sm py-3">
<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    
                    
                        <td>{{ $user['id']}}</td>
                        <td>
                        @role('system admin|system editor|system user')
                            {{ $user['first_name']}}
                        @endrole
                        @role('company admin|company user')
                            {{ $user['admin_sub_accounts'][0]['first_name']}}
                        @endrole
                        </td>
                        <td>
                        @role('system admin|system editor|system user')
                            {{ $user['last_name']}}
                        @endrole
                        @role('company admin|company user')
                            {{ $user['admin_sub_accounts'][0]['last_name']}}
                        @endrole
                        </td>
                        <td>
                        @role('system admin|system editor|system user')
                            {{ $user['last_name']}}
                        @endrole
                        @role('company admin|company user')
                            @if(!empty($company['admin_sub_accounts'][0]))
                                {{ $user['admin_sub_accounts'][0]['last_name']}}
                            @else 
                                {{ $user['admin_sub_accounts'][0]['last_name']}}
                            @endif
                        @endrole
                        </td>
                        <td>
                        @role('system admin|system editor|system user')
                            {{ $user['address']}}
                        @endrole
                        @role('company admin|company user')
                            @if(!empty($company['admin_sub_accounts'][0]))
                                {{ $user['admin_sub_accounts'][0]['address']}}
                            @else
                                {{ $user['admin_sub_accounts'][0]['address']}}
                            @endif
                        @endrole
                        </td>
                        <td>
                        @role('system admin|system editor|system user')
                            {{ $user['phone_number']}}
                        @endrole
                        @role('company admin|company user')
                            @if(!empty($company['admin_sub_accounts'][0])) 
                                {{ $user['admin_sub_accounts'][0]['phone_number']}}
                            @else 
                                {{ $user['admin_sub_accounts'][0]['phone_number']}}
                            @endif
                        @endrole
                        </td>
                        <td>
                        @role('system admin|system editor|system user')
                            {{ $user['email']}}
                        @endrole
                        @role('company admin|company user')
                            @if(!empty($company['admin_sub_accounts'][0])) 
                                {{ $user['admin_sub_accounts'][0]['email']}}
                            @else 
                                {{ $user['admin_sub_accounts'][0]['email']}}
                            @endif
                        @endrole
                        </td>
                        <td>
                        @role('system admin|system editor|system user')
                            {{ $user['username']}}
                        @endrole
                        @role('company admin|company user')
                            @if(!empty($company['admin_sub_accounts'][0])) 
                                {{ $user['admin_sub_accounts'][0]['username']}}
                            @else 
                                {{ $user['admin_sub_accounts'][0]['username']}}
                            @endif
                        @endrole
                        </td>
                        <td>
                        @role('system admin|system editor|system user')
                            {{ $user['first_name']}}
                        @endrole
                        @role('company admin|company user')
                            @if(!empty($company['admin_sub_accounts'][0])) 
                                {{ $user['admin_sub_accounts'][0]['role']}}
                            @else
                                {{ $user['admin_sub_accounts'][0]['role']}}
                            @endif
                        @endrole
                        </td>
                    <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                        <span class="fas fa-align-right"></span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                            @role('system admin|system editor')
                            <a class="dropdown-item" href="{{ url('users/edit/'.$user['id'])}}"><span class="fas fa-pen mr-2"></span>Edit User</a>
                            @endrole
                            @role('system admin')
                                @if($user['is_activated'])
                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#deactivate{{ $user['id'] }}"><span class="fas fa-eye-slash mr-2"></span>Deactivate User</a>
                                @else
                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#activate{{ $user['id'] }}"><span class="fas fa-eye mr-2"></span>Activate User</a>
                                @endif
                            @endrole
                        </div>
                    </div>
                    </td>
                </tr>
            
                <!-- deactivate Modal -->
                <div class="modal fade" id="deactivate{{ $user['id'] }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deactivateModal">Deactivate User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {{$user['id']}}
                            <div class="modal-body">
                                <form action="{{ url('users/deactivate/'.$user['id']) }}" method="post">
                                    @csrf
                                    <input type="submit" class="btn btn-danger" value="Deactivate User">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- activate Modal -->
                <div class="modal fade" id="activate{{ $user['id'] }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="activateModal">Deactivate User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {{$user['id']}}
                            <div class="modal-body">
                                <form action="{{ url('users/activate/'.$user['id']) }}" method="post">
                                    @csrf
                                    <input type="submit" class="btn btn-danger" value="Activate User">
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
