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
                <th class="d-none">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($completeorders as $completeorder)
            <tr>
                <td><span>{{ $completeorder['id'] }}</span></td>
                <td><span>{{ $completeorder['user'][0]['username'] }}</span></td>
                <td><span>{{ $completeorder['company'][0]['company_name'] }}</span></td>
                <td><span>{{ $completeorder['type'] }}</span></td>
                <td><span>{{ $completeorder['offer'] }}</span></td>
                <td><span>{{ $completeorder['url'] }}</span></td>
                <td><span>{{ $completeorder['publishing_date'] }} </span></td>
                <td><span>{{ $completeorder['created_at'] }} </span></td>
                <td><span>{{ $completeorder['completed_at'] }} </span></td>
                <td><span class="badge {{ $completeorder['status'] == 'pending' ? 'badge-warning' : (($completeorder['status'] == 'processing') ? 'badge-primary' : 'badge-success') }}">{{ $completeorder['status'] }} </span></td>
                <td class="d-none">
                <div class="btn-group">
                    <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                    <span class="fas fa-align-right"></span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                    </div>
                </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
</div>
@endsection
