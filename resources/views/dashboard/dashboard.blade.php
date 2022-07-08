@extends('layouts.app')

@section('title',"My Dashboard")
@section('content')
<div class="py-3">
    <div class="col-12">
        <form action="{{ route('filter') }}" method="post">
            @csrf
            <label for="filter_date" class="form-label">Filter by month :</label>
            <div class="form-inline">
                <div class="form-group mx-0 mb-2">
                    <select name="filter_date" id="filter_date" class="form-control">
                        @foreach($monthsArray as $m)
                            <option {{ $m['digit'] == $month ? "selected" : "" }} value="{{ $m['digit'] }}">{{ $m['month'] }}</option>
                        @endforeach
                    </select>
                </div>
            <div class="form-group mx-0 ml-sm-2 mb-2">
                <input type="submit" class="btn btn-success " value="Filter">
            </div>
            </div>
        </form>
    </div>
    <!-- domains -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center text-primary"><b>Domains</b></h2>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-success"><b>{{ $domainTotal }}</b></h2>
                                <span class="text-primary font-weight-bold">Total</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-success"><b>{{ $domainsAdded }}</b></h2>
                                <span class="text-primary font-weight-bold">Added</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-success"><b>{{ $domainUsedSum }}</b></h2>
                                <span class="text-primary font-weight-bold">Used</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- created articles -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center text-primary"><b>Created Articles</b></h2>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-success"><b>{{ $articleCreated }}</b></h2>
                                <span class="text-primary font-weight-bold">Total</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-success"><b>{{ $articlePublished }}</b></h2>
                                <span class="text-primary font-weight-bold">Published</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-warning"><b>{{ $articlePending }}</b></h2>
                                <span class="text-primary font-weight-bold">Pending</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ordered articles -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center text-primary mb-3"><b>Ordered Articles</b></h2>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                 <h2 class="text-dark"><b>{{ $articleOrdered }}</b></h2>
                                <span class="text-primary font-weight-bold">Total</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-success"><b>{{ $articleOrderedCompleted }}</b></h2>
                                <span class="text-primary font-weight-bold">Published</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-primary"><b>{{ $articleOrderedProcessing }}</b></h2>
                                <span class="text-primary font-weight-bold">Processing</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-warning"><b>{{ $articleOrderedPending }}</b></h2>
                                <span class="text-primary font-weight-bold">Pending</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection