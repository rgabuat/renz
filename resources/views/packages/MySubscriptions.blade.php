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
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $mysubs)
            <tr>
                <td><span>{{ $mysubs['id'] }}</span></td>
                <td><span>{{ $mysubs['user'][0]['first_name'] }} {{ $mysubs['user'][0]['last_name'] }}</span></td>
                <td><span>{{ $mysubs['user'][0]['company'][0]['company_name'] }}</span></td>
                <td><span>{{ $mysubs['avail_credits']}}</span></td>
                <td><span class="badge {{ $mysubs['status'] == 0 ? 'badge-warning' : 'badge-success' }}">{{ $mysubs['status'] == 0 ? 'Pending' : 'Approved'}}</span></td>
                <td><span>{{ $mysubs['package'][0]['name']}}</span></td>
                <td><span>{{ $mysubs['created_at'] }}</span></td>
                <td><span>{{ $mysubs['updated_at'] }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
</div>
@endsection