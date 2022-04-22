@extends('layouts.app')



@section('content')
<table class="table">
    <thead>
        <tr>
            <th>S/N</th>
            <th>Company</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Address</th>
            <th>Reg No.</th>
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
            <td>{{ $user['company']}}</td>
            <td>{{ $user['first_name']}}</td>
            <td>{{ $user['last_name']}}</td>
            <td>{{ $user['address']}}</td>
            <td>{{ $user['reg_number']}}</td>
            <td>{{ $user['phone_number']}}</td>
            <td>{{ $user['username']}}</td>
            <td>{{ $user['email']}}</td>
            <td>{{ $user['role']}}</td>
            <td>
            <div class="btn-group">
                <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                <span class="fas fa-align-right"></span>
                </button>
                <div class="dropdown-menu" role="menu" style="">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
