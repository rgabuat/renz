@extends('layouts.app')

@section('title',"My Dashboard")
@section('content')
<div class="py-3">
    <!-- domains -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center text-primary"><b>Domains</b></h2>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2><b>40</b></h2>
                                <p>Total Domains</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2><b>40</b></h2>
                                <p>Added Domains</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2><b>40</b></h2>
                                <p>Used Domains</p>
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
                                <h2><b>40</b></h2>
                                <p>Total Domains</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2><b>40</b></h2>
                                <p>Added Domains</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2><b>40</b></h2>
                                <p>Used Domains</p>
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
                <h2 class="text-center text-primary"><b>Ordered Articles</b></h2>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2><b>40</b></h2>
                                <p>Total Domains</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2><b>40</b></h2>
                                <p>Added Domains</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2><b>40</b></h2>
                                <p>Used Domains</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2><b>40</b></h2>
                                <p>Used Domains</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-lg-3 col-md-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $domains }}</h3>
                    <p>Domains</p>
                </div>
                <!-- <div class="icon">
                    <i class="ion ion-globe"></i>
                </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-globe"></i></a> -->
            </div>
        </div>
        @role('system admin|system editor|system user')
        <div class="col-lg-3 col-md-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $articledPublished }}</h3>
                    <p>Artcile Published</p>
                </div>
                <!-- <div class="icon">
                    <i class="ion ion-globe"></i>
                </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-globe"></i></a> -->
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $articleOrderedPublished }}</h3>
                    <p>Article Order Published</p>
                </div>
                <!-- <div class="icon">
                    <i class="ion ion-globe"></i>
                </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-globe"></i></a> -->
            </div>
        </div>
        @endrole

        <div class="col-lg-3 col-md-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $articleCreated }}</h3>
                    <p>Article Created</p>
                </div>
                <!-- <div class="icon">
                    <i class="ion ion-globe"></i>
                </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-globe"></i></a> -->
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $articleOrdered }}</h3>
                    <p>Article Ordered</p>
                </div>
                <!-- <div class="icon">
                    <i class="ion ion-globe"></i>
                </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-globe"></i></a> -->
            </div>
        </div>
    </div>
</div>
@endsection