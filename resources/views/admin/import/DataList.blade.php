@extends('layouts.app')

@section('content')
<div class="table-responsive-sm py-3">
    <div class="card">
        <div class="card-body">
        @if (session('status'))
            <div class="bg-success text-center text-white py-2 mb-3">
                {{ session('status') }}
            </div>
        @endif
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
                    <th class="d-none">Remarks</th>
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
                    <td class="d-none">{{ $domain_data['remarks']}}</td>
                    <td>{{ date('m/d/Y', strtotime($domain_data['last_updated']))}}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                            <span class="fas fa-align-right"></span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                @role('system admin|system editor|company admin')
                                <a class="dropdown-item" href="{{ url('domain/edit/'.$domain_data['id'])}}"><span class="fas fa-pen mr-2"></span>Edit Domain</a>
                                @endrole
                                @role('system admin')
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#deactivate{{ $domain_data['id'] }}"><span class="fas fa-trash mr-2"></span>Delete Domain</a>
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
                                <h5 class="modal-title" id="deactivateModal">Delete Domain</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('domain/delete/'.$domain_data['id']) }}" method="post">
                                    @csrf
                                    <h3 class="text-center">Delete Domain</h3>
                                    <p class="text-center"><input type="submit" class="btn btn-danger" value="Delete Domain"></p>
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
        </div>
    </div>        
<div>
@endsection
