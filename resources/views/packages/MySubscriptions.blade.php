@extends('layouts.app')

@section('title',"Subscription Requests")
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
            </tr>
        </thead>
        <tbody>

            @foreach($subscriptions as $mysubs)
            <tr>
                <td><span>{{ $mysubs['id'] }}</span></td>
                <td>{!! Str::limit($mysubs['user'][0]['first_name'].' '.$mysubs['user'][0]['last_name'],10, ' ...') !!}</td>
                <td>{!! Str::limit($mysubs['user'][0]['company'][0]['company_name'],10, ' ...') !!}</td>
                <td><span>{{ $mysubs['avail_credits']}}</span></td>
                <td>{!! Str::limit($mysubs['package'][0]['name'],10, ' ...') !!}</td>
                <td><span>{{ Carbon\Carbon::parse($mysubs['created_at'])->format('Y-m-d') }}</span></td>
                <td><span>{{ Carbon\Carbon::parse($mysubs['updated_at'])->format('Y-m-d')}}</span></td>
                <td><span class="badge {{ $mysubs['status'] == 0 ? 'badge-warning' : 'badge-success' }}">{{ $mysubs['status'] == 0 ? 'Pending' : 'Approved'}}</span> <span>{{ $mysubs['status'] != 0 ? $currSub[0]->package_id == $mysubs['id']  ? '(active)' : ($mysubs['expire_at'] == Carbon\Carbon::now() ? 'ended' : '') : '' }} </span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
</div>
@endsection
