@extends('layouts.app')

@section('content')
<div class="table-responsive-sm">
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
        @foreach($companies as $company)
        <tr>
            <td>{{ $company['id'] }}</td>
            <td>{{ $company['first_name']}}</td>
            <td>{{ $company['last_name']}}</td>
            <td>{{ $company['address']}}</td>
            <td>{{ $company['phone_number']}}</td>
            <td>{{ $company['email']}}</td>
            <td>{{ $company['username']}}</td>
            <td>{{ $company['role']}}</td>
            <td>
            <div class="btn-group">
                <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                <span class="fas fa-align-right"></span>
                </button>
                <div class="dropdown-menu" role="menu" style="">
                   
                    @role('system admin|system editor|company admin')
                        <a class="dropdown-item" href="{{ url('company/edit/user/'.$company['id'])}}"><span class="fas fa-pen mr-2"></span>Edit User</a>
                    @endrole
                    @role('system admin')
                        @if($company['is_activated'] == 1)
                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#deactivate{{ $company['id'] }}"><span class="fas fa-eye-slash mr-2"></span>Deactivate User</a>
                        @else
                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#activate{{ $company['id'] }}"><span class="fas fa-eye mr-2"></span>Activate User</a>
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
                        <h5 class="modal-title" id="deactivateModal">Deactivate User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    Deactivate User
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
                        <h5 class="modal-title" id="activateModal">Deactivate User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    Activate User
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
<div>
@endsection
