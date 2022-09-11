@extends('layouts.app')

@section('title',"Users")
@section('content')
<div class="table-responsive-sm py-3">
<div class="card">
    <div class="card-body">
        <h2 class="text-primary"><b>Users</b></h2>
        <table class="table" id="tbl_users">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Full name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user['id'] }}</td>
                <td>{{ $user['first_name']}} {{ $user['last_name']}}</td>
                <td>{{ $user['email']}}</td>
                <td>{{ $user['role']}}</td>
                <td>{{ $user['username']}}</td>
                <td><span class="badge {{ $user['is_activated'] == 1 ? 'badge-success' : 'badge-danger'  }}">{{ $user['is_activated'] == 1 ? 'Active' : 'Deactivated'  }}</span></td>
                <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                    <span class="fas fa-align-right"></span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                        @role('system admin|system editor')
                            <a class="dropdown-item" href="{{ url('users/view/'.$user['id'])}}"><span class="fas fa-eye mr-2"></span>View User</a>
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
                       
                        <div class="modal-body">
                            <form action="{{ url('users/deactivate/'.$user['id']) }}" method="post">
                                @csrf
                                 <p>Are you sure you want to deactive user: <span><b>{{$user['username']}}'s</b></span> account ?</p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-danger" value="Deactivate">
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
                            <h5 class="modal-title" id="activateModal">Activate User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('users/activate/'.$user['id']) }}" method="post">
                                @csrf
                                <p>Are you sure you want to Activate user: <span><b>{{$user['username']}}'s </b></span> account ?</p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-success" value="Activate User">
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
