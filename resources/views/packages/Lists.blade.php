@extends('layouts.app')

@section('title',"Packages")
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
        <table class="table" id="packages_tbl">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Credits</th>
                <th>Interval</th>
                <th>Interval Count</th>
                <th>Description</th>
                <th>Payment method</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($packages as $package)
            <tr>
                <td>{{ $package['id'] }}</td>
                <td>{!! Str::limit($package['name'],8, ' ...') !!}</td>
                <td>{{ $package['amount'] }}</td>
                <td>{{ $package['currency'] }}</td>
                <td>{{ $package['credits'] }}</td>
                <td>{{ $package['billing_method'] }}</td>
                <td>{{ $package['interval_count'] }} </td>
                <td>{!! Str::limit($package['description'],20, ' ...') !!}</td>
                <td>{{ $package['payment_method'] }}</td>
                <td>{{  Carbon\Carbon::parse($package['created_at'])->format('Y-m-d') }}</td>
                <td>{{  Carbon\Carbon::parse($package['updated_at'])->format('Y-m-d') }}</td>
                <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-warning " data-toggle="dropdown" aria-expanded="false">
                    <span class="fas fa-align-right"></span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                    <a class="dropdown-item" href="javacsript:void(0);" data-toggle="modal" data-target="#view{{ $package['id'] }}"><span class="fas fa-eye mr-2"></span>View Packge</a>
                        @role('company admin|company user')
                            <a class="dropdown-item" href="{{ url('package/checkout/'.$package['plan_id']) }}" ><span class="fas fa-shopping-cart mr-2"></span>Buy Packge</a>
                        @endrole
                        @role('system admin|system editor')
                            <!-- <a class="dropdown-item" href="javacsript:void(0);" data-toggle="modal" data-target="#edit{{ $package['id'] }}"><span class="fas fa-pen mr-2"></span>Edit Packge</a> -->
                            @role('system admin')
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#delete{{ $package['id'] }}"><span class="fas fa-trash mr-2"></span>Delete Package</a>
                            @endrole
                        @endrole
                    </div>
                </div>
                </td>
            </tr>

            <!-- view Package Modal -->
            <div class="modal fade" id="view{{ $package['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="view">View Package Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Name: <b>{{ $package['name'] }}</b></p>
                            <p>Amount: <b>{{ $package['amount'] }}</b></p>
                            <p>Currency: <b>{{ $package['currency'] }}</b></p>
                            <p>Credits: <b>{{ $package['credits'] }}</b></p>
                            <p>Payment: <b>{{ $package['payment_method'] }}</b></p>
                            @role('system admin|system editor|system user')
                                <p>Duration: <b>{{ $package['duration'] }} {{ Str::plural('Month', $package['duration']) }}</b></p>
                                <p>Date created: <b>{{ Carbon\Carbon::parse($package['created_at'])->format('Y-m-d') }}</b></p>
                            @endrole
                            <p>Date Updated: <b>{{ Carbon\Carbon::parse($package['updated_at'])->format('Y-m-d') }}</b></p>
                            <p>Description: <b>{!! $package['description'] !!}</b></p>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- edit Package Modal -->
            <div class="modal fade" id="edit{{ $package['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit">Edit Package</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                            <form action="{{ url('package/update/'.$package['id']) }}" method="post">
                                @csrf
                                <div class="col-md-12">
                                        <label for="name">Package name <span class="text-danger">*</span> </label>
                                        <div class="form-group ">
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $package['name'] }}" >
                                            @error('name')
                                                <span class="error invalid-feedback"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="price">Price<span class="text-danger">*</span> </label>
                                        <div class="form-group ">
                                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ $package['amount'] }}" >
                                            @error('price')
                                                <span class="error invalid-feedback"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="credits">Credits<span class="text-danger">*</span> </label>
                                        <div class="form-group ">
                                            <input type="number" name="credits" class="form-control @error('credits') is-invalid @enderror" value="{{ $package['credits'] }}" >
                                            @error('credits')
                                                <span class="error invalid-feedback"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="payment_method">Payment method<span class="text-danger">*</span> </label>
                                        <div class="form-group ">
                                            <select name="payment_method"  id="payment_method" class="form-control @error('payment_method') is-invalid @enderror">
                                                <option value="">Select Payment method</option>
                                                <option {{ $package['payment_method'] == "credit card" ? 'selected' :'' }} value="credit card">Credit Card</option>
                                                <option {{ $package['payment_method'] == "invoice" ? 'selected' :'' }} value="invoice">invoice</option>
                                            </select>
                                            @error('payment_method')
                                                <span class="error invalid-feedback"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="duration">Interval<span class="text-danger">*</span> </label>
                                        <div class="form-group ">
                                            <input type="number" name="interval" value="{{ isset($package['billing_method']) }}"class="form-control @error('interval') is-invalid @enderror">
                                            @error('duration')
                                                <span class="error invalid-feedback"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="duration">Duration<span class="text-danger">*</span> </label>
                                        <div class="form-group ">
                                            <select name="duration" id="payment_method" class="form-control @error('duration') is-invalid @enderror">
                                                <option value="">Select Duration</option>
                                                <option {{ $package['billing_method'] == "week" ? 'selected' :'' }} value="{{$package['billing_method']}}">Weekly</option>
                                                <option {{ $package['billing_method'] == "month" ? 'selected' :'' }} value="{{$package['billing_method']}} ">Monthly</option>
                                                <option {{ $package['billing_method'] == "year" ? 'selected' :'' }} value="{{$package['billing_method']}} ">Yearly</option>
                                            </select>
                                            @error('duration')
                                                <span class="error invalid-feedback"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="desecription">Description</label>
                                            <textarea name="description" id=""  cols="" rows="5" class="form-control @error('description') is-invalid @enderror">{{ $package['description'] }}</textarea>
                                        </div>
                                        @error('description')
                                            <span class="error invalid-feedback"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-primary" value="UPDATE PACKAGE">
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
                            <form action="{{ url('package/delete/'.$package['id']) }}" method="post">
                                @csrf
                                <input type="hidden" name="package_id" value="{{ $package['plan_id'] }}">
                                <p>Are you sure you want to delete Package: <span><b>{{ $package['name'] }}</b></span></p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-danger" value="DELETE">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @role('company admin|company user')
            <!-- buy Package Modal -->
            <div class="modal fade" id="buy{{ $package['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="buy">Buy Package</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('package/buy/'.$package['plan_id']) }}" method="post">
                                @csrf
                                <p>Buy this Package: <span><b>{{ $package['name'] }}</b></span></p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-success" value="BUY">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            @endforeach
        </tbody>
    </table>
    </div>
</div>
</div>
@endsection
