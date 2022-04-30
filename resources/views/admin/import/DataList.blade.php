@extends('layouts.app')

@section('content')
<div class="table-responsive-sm">
<table class="table">
    <thead>
        <tr>
            <th>S/N</th>
            <th>Domain</th>
            <th>Country</th>
            <th>Domaint Rating</th>
            <th>Traffic</th>
            <th>Reference Domain</th>
            <th>Token Cost</th>
            <th>Remarks</th>
            <th>Last updated</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($domain_datas as $domain_data)
        <tr>
            <td>{{ $domain_data['id']}}</td>
            <td>{{ $domain_data['domain']}}</td>
            <td>{{ $domain_data['country']}}</td>
            <td>{{ $domain_data['domain_rating']}}</td>
            <td>{{ $domain_data['traffic']}}</td>
            <td>{{ $domain_data['ref_domain']}}</td>
            <td>{{ $domain_data['token_cost']}}</td>
            <td>{{ $domain_data['remarks']}}</td>
            <td>{{ $domain_data['last_updated']}}</td>
            <td>
            <div class="btn-group">
                <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                <span class="fas fa-align-right"></span>
                </button>
                <div class="dropdown-menu" role="menu" style="">
                   
                    @role('system admin|system editor|company admin')
                    <a class="dropdown-item d-none" href="{{ url('company/edit/'.$domain_data['id'])}}"><span class="fas fa-pen mr-2"></span>Edit Data</a>
                    @endrole
                    
                </div>
            </div>
            </td>
        </tr>
     
        <!-- deactivate Modal -->
        <div class="modal fade" id="deactivate{{ $domain_data['id'] }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deactivateModal">Deactivate company</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{$domain_data['id']}}
                    <div class="modal-body">
                        <form action="{{ url('company/deactivate/'.$domain_data['id']) }}" method="post">
                            @csrf
                            <input type="submit" class="btn btn-danger" value="Deactivate company">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- activate Modal -->
        <div class="modal fade" id="activate{{ $domain_data['id'] }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="activateModal">Deactivate company</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{$domain_data['id']}}
                    <div class="modal-body">
                        <form action="{{ url('company/activate/'.$domain_data['id']) }}" method="post">
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
