@extends('layouts.app')

@section('title',"Users")
@section('content')
<div class="table-responsive-sm py-3">
<div class="card">
    <div class="card-body">
        <h2 class="text-primary"><b>Packages</b></h2>
        @if (session('status'))
            <div class="bg-success text-center text-white py-2 mb-3">
                {{ session('status') }}
            </div>
        @endif
        <table class="table">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Credits</th>
                <th>Payment method</th>
                <th>Duration</th>
                <th>Created by</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($packages as $package)
            <tr>
                <td>{{ $package['id'] }}</td>
                <td>{{ $package['name'] }}</td>
                <td>{{ $package['price'] }}</td>
                <td>{{ $package['description'] }}</td>
                <td>{{ $package['credits'] }}</td>
                <td>{{ $package['payment_method'] }}</td>
                <td>{{ $package['duration'] }}</td>
                <td>{{ $package['created_by'] }}</td>
                <td>{{ $package['created_at'] }}</td>
                <td>{{ $package['updated_at'] }}</td>
                <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                    <span class="fas fa-align-right"></span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                            <a class="dropdown-item" href="javacsript:void(0);" data-toggle="modal" data-target="#edit{{ $package['id'] }}"><span class="fas fa-pen mr-2"></span>Edit Packge</a>
                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#delete{{ $package['id'] }}"><span class="fas fa-trash mr-2"></span>Delete Package</a>
                    </div>
                </div>
                </td>
            </tr>
        
            <!-- edit Package Modal -->
            <div class="modal fade" id="edit{{ $package['id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit">Edit Package</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            <form action="{{ url('users/deactivate/') }}" method="Package">
                                @csrf
                                
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="UPDATE">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- delete Package Modal -->
            <div class="modal fade" id="delete{{ $package['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="Delete">Delete Package</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('package/delete/'.$package['id']) }}" method="Package">
                                @csrf
                                <p>Are you sure you want to delete Package: <span><b>{{ $package['title'] }}</b></span></p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-danger" value="DELETE">
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
