@extends('layouts.landing.main')
@section('css')
   <style>
    #myList tr{ display:none;
        }
        #loadMore {
            color:green;
            cursor:pointer;
        }
        #loadMore:hover {
            color:black;
        }
   </style>
@stop
@section('title',"Domænerne")
@section('content')
<div class="container p-4 my-5">
   <div class="row">
    <div class="col-lg-6">
        <h2 class="mb-4" style="color:#003F87;"><strong>Her er vores domæner du kan udgive på. Der kommer nye hele tiden.</strong></h2>
        <p>
        Alle vores hjemmesider er emne specifikke eller nyhedssider med generelt indhold.
        </p>
        <p>
        <strong>Du vil få adgang til hjemmesider med op til DR 62 og med trafik</strong>
        </p>
    </div>
    <div class="col-lg-6">
        <img src="{{ asset('vendors/dist/img/undraw_domain_img.png') }}" class="img-fluid" alt="">
    </div>
    <div class="col-12 mt-5">
    <div class="table-responsive">
        <table id="domain_table" class="table" >
            <tr>
                <th>No.</th>
                <th>Navn</th>
                <!-- <th>IP</th> -->
                <th>DR</th>
                <th>Links</th>
                <th>Ref. Domæner</th>
            </tr>
            <tbody id="myList">
                @foreach($domains as $domain)
                @php
                  $str = ($domain->domain);
                  $str_length = strlen($str);
                  $masked = substr($str, 0, 1).str_repeat('*', $str_length - 2).substr($str, $str_length - 4, 4);
                @endphp
                <tr class="item">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $masked }}</td>
                    <td>{{ $domain->domain_rating }}</td>
                    <td>{{ $domain->traffic }}</td>
                    <td>{{ $domain->ref_domain }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        <div class="col-12 text-center">
            <button id="loadMore" class="btn btn-primary text-light my-2">Load more</button>
        </div>
    </div>
    <div class="col-12 " style="padding-top:120px;">
        <h3 class="text-center"><strong>P R I S E R</strong></h3>
        <div class="row my-5">
        <div class="col-lg-4 col-md-6 col-xs-12">
        <div class="card">
            <div class="card-body text-center">
            <h4 class="text-uppercase text-primary">
                <strong>10 <br>publications</strong>
            </h4>
            <p>
            <strong>
                100 euro <br>(10 euro per publication)
            </strong>
            </p>
            <p class=" text-secondary">
                <span>10 publications per month</span>
            </p>
            <hr>
            <p class=" text-dark">
                <span>Access to more than <strong>400</strong> websites</span>
            </p>
            <hr>
            <p class=" text-secondary">
                <span>You can upload your own texts</span>
            </p>
            <hr>
            <p class=" text-secondary">
                <span>You can order texts directly</span>
            </p>
            <hr>
            <button type="button" class="btn btn-success">
                Order now
            </button>
            </div>
        </div>
        </div>
        <div class="col-lg-4 col-md-6 col-xs-12">
        <div class="card">
        <div class="card-body text-center">
            <h4 class="text-uppercase text-primary">
                <strong>50 <br>publications</strong>
            </h4>
            <p>
            <strong>
                300 euro <br>(6 euro per publication)
            </strong>
            </p>
            <p class=" text-secondary">
                <span>50 publications per month</span>
            </p>
            <hr>
            <p class=" text-dark">
                <span>Access to more than <strong>400</strong> websites</span>
            </p>
            <hr>
            <p class=" text-secondary">
                <span>You can upload your own texts</span>
            </p>
            <hr>
            <p class=" text-secondary">
                <span>You can order texts directly</span>
            </p>
            <hr>
            <button type="button" class="btn btn-success">
                Order now
            </button>
            </div>
        </div>
        </div>
        <div class="col-lg-4 col-md-6 col-xs-12">
        <div class="card">
        <div class="card-body text-center">
            <h4 class="text-uppercase text-primary">
                <strong>100 <br>publications</strong>
            </h4>
            <p>
            <strong>
                500 euro <br>(5 euro per publication)
            </strong>
            </p>
            <p class=" text-secondary">
                <span>100 publications per month</span>
            </p>
            <hr>
            <p class=" text-dark">
                <span>Access to more than <strong>400</strong> websites</span>
            </p>
            <hr>
            <p class=" text-secondary">
                <span>You can upload your own texts</span>
            </p>
            <hr>
            <p class=" text-secondary">
                <span>You can order texts directly</span>
            </p>
            <hr>
            <button type="button" class="btn btn-success">
                Order now
            </button>
            </div>
        </div>
        </div>
    </div>
    </div>
   </div>
</div>

<!-- /.login-box -->
</div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {

        var rowCount = $('#domain_table >tbody >tr').length;
        x=11;

        jQuery('#domain_table >tbody >tr:lt('+x+')').show();

        jQuery('#loadMore').click(function (e) {
        e.preventDefault();
            x = (x+5 <= rowCount) ? x+5 : rowCount;
            jQuery('#domain_table >tbody >tr:lt('+x+')').show();

            if( x < rowCount)
            {
                $('#domain_table >tbody >tr:lt('+x+')').show();
            }
            else
            {
                $('#domain_table >tbody >tr:lt('+x+')').show();
                $('#loadMore').hide();
            }
         });
        });
    </script>
@stop