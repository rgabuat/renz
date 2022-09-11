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
                <td><span>{{ $mysubs['plan'][0]['credits']}}</span></td>
                <td>{!! Str::limit($mysubs['plan'][0]['name'],10, ' ...') !!}</td>
                <td><span>{{ Carbon\Carbon::parse($mysubs['created_at'])->format('Y-m-d') }}</span></td>
                <td><span>{{ Carbon\Carbon::parse($mysubs['updated_at'])->format('Y-m-d')}}</span></td>
                <td><span class="badge p-2 {{ $mysubs['status'] == 0 ? 'badge-warning' : ($mysubs['status'] == 1 ? 'badge-success' : 'badge-danger') }}">{{ $mysubs['status'] == 0 ? 'Pending' : ($mysubs['status'] == 1 ? 'Active' : 'Declined')}}</span></td>
            </tr>


             <!-- cancel Package Modal -->
             <div class="modal fade" id="cancel{{ $mysubs['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="Cancel">Cancel Package</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('package/cancel/'.$mysubs['id']) }}" method="post">
                                @csrf
                                <input type="hidden" name="sub_duration" value="{{ $mysubs['plan'][0]['duration'] }}">
                                <input type="hidden" name="sub_credits" value="{{ $mysubs['plan'][0]['credits'] }}">
                                <p>Are you sure you want to cancel Package: <span><b>{{ $mysubs['id'] }}</b></span></p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-danger" value="SUBMIT">
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
