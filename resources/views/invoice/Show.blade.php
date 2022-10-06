@extends('layouts.app')

@section('title',"Invoivce")
@section('content')


@php
     $total_article = 0;
     $total_subscription = 0;
@endphp

<div class="table-responsive-sm py-3">
<div class="card">
    <div class="card-body">
        <h2 class="text-primary"><b>Billing Invoice</b></h2>
        <a href="{{ url('invoice/generate-pdf/'.Request::segment(3)) }}">GENERATE PDF</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                Company Logo
                <br>
                Company Address 
                <br>
                test@email.com
                <br>
            </div>
            <div class="col-md-6">
                @foreach($invoice_details as $value)
                    Invoice: <b>{{$value['id']}}</b>
                    <br>
                    Date Issued: <b>{{$value['invoice_date_gen']}}</b>
                    <br>
                    Due Date:
                    <br>
                @endforeach
            </div>
        </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
                <h5 class="text-primary">Invoice To:</h5>
                Renz Martin Cerico
                <br>
                test address USA
                <br>
                test@email.com
                <br>
            </div>
        </div>
    </div>
</div>
    <div class="card ">
        <div class="card-body p-0">
            <table class="table rounded">
                <thead class="bg-secondary">
                    <tr>
                        <th><span>Subscription</span></th>
                        <th class="text-right"><span>Amount</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subsItms as $key)
                    <tr>
                        <td>Subscriptions Total</td>
                        <td class="text-right">${{ $key['subscription_invoice'][0]['amount_due'] }}</td>
                        @php 
                             $total_subscription+=$key['subscription_invoice'][0]['amount_due'] 
                        @endphp
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                    <td><strong>Sum</strong></td>
                    <td class="text-right" ><strong>${{$total_subscription}}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0">
                <table class="table rounded">
                    <thead class="bg-secondary">
                        <tr>
                            <th><span>Articles Ordered</span></th>
                            <th><span>Heading</span></th>
                            <th><span>Date created</span></th>
                            <th class="text-right"><span>Amount</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($artOrdItms as $articleOrder)
                        <tr>
                            <td>{{$articleOrder['articleOrder'][0]['ord_id']}}</td>
                            <td>{{ $articleOrder['articleOrder'][0]['heading']}}</td>
                            <td>{{ $articleOrder['articleOrder'][0]['created_at']}}</td>
                            <td class="text-right">{{ $articleOrder['articleOrder'][0]['price']}}</td>
                            @php 
                                $total_article+=$articleOrder['articleOrder'][0]['price'];
                            @endphp
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <td><strong>Sum</strong></td>
                        <td colspan="3" class="text-right" ><strong>${{$total_article}}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <table class="table">
                <thead class="bg-primary">
                    <tr>
                        <th><span>Summary</span></th>
                        <th class="text-right"><span>Amount</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Subscriptions Total</td>
                        <td class="text-right">${{$total_subscription}}</td>
                    </tr>
                    <tr>
                        <td>Article Orders Total</td>
                        <td class="text-right">${{$total_article}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                    <td><strong>Sum</strong></td>
                    <td class="text-right" ><strong>${{ $total_article+$total_subscription }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
