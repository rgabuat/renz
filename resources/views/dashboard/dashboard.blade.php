@extends('layouts.app')

@section('title',"My Dashboard")
@section('content')
<div class="py-3">
    <!-- domains -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center text-primary"><b>Domains</b></h2>
                   
                
                        

                        @foreach($arrayMonths['name'] as $names)
                            {{ $names }}
                        @endforeach
                  
                <select name="filter_date" id="filter_date">
                    <option value="@foreach($arrayMonths['digits'] as $digits)
                            {{ $digits }}
                        @endforeach"></option>  
                </select>
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
                                <h2 class="text-success"><b>{{ $articlePending }}</b></h2>
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
                <hr>
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