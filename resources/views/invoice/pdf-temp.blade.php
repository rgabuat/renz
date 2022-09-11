<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="invoice.css">
<style>
table {
  width: 100%;
  border: none;
  border-collapse:collapse;
}
</style>
</head>
<body style="">

@php
     $total_article = 0;
     $total_subscription = 0;
@endphp

    <h1>Billing Invoice</h1>
    <h3>Invoice From</h3>
    <div style="float:left;">
        Company name<br/>
        Company Address<br/>
        test@gmail.com<br/>
    </div>


    <div style="float:right;">
        Invoice: <b>{{$invoice_details[0]->id}}</b>
        <br/>
        Date Issued: <b>{{$invoice_details[0]->invoice_date_gen}}</b>
        <br/>
        <span>Due Date:: #</span><br/>
    </div>
    <div style="clear: both;"></div>
    <div style="float:left;">
        <h3>Invoice To</h3>
        <span>{{$user_cmpny_details[0]->company_name}}</span><br/>
        <span>companyemail</span><br/>
        <span>test@companyemail.com</span><br/>
    </div>
    <br>
    <div style="clear: both;"></div>
    <h3 style="margin-top: 3rem">Bill to</h3>
    <table class="table" style="width:100%;" >
        <thead style="background:#3a3a3c;color:#ffff;">
            <tr>
                <th style="padding:10px; text-align:left">Subscription</th>
                <th style="padding:10px; text-align:right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subsItms as $key)
                <tr>
                    <td>Subscriptions Total</td>
                    <td class="text-right">${{ $key['subscription'][0]['amount_due'] }}</td>
                    @php 
                         $total_subscription+=$key['subscription'][0]['amount_due'] 
                    @endphp
                </tr>
             @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="padding:10px;"><strong><b>Total</b></strong></td>
                <td style="padding:10px; text-align:right"><span><b>${{$total_subscription}}</b></span></td>
            </tr>
        </tfoot>
    </table>
    <div style="clear:both;"></div>
    <br>
    <br>
    <table class="table" style="width:100%;" >
        <thead style="background:#F5F5F5;">
            <tr>
                <th style="padding:10px;text-align:left">Articles Ordered</th>
                <th style="padding:10px;text-align:left">Heading</th>
                <th style="padding:10px;text-align:left">Date Created</th>
                <th style="padding:10px; text-align:right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($artOrdItms as $articleOrder)
            <tr>
                <td style="padding:10px;">{{$articleOrder['articleOrder'][0]['ord_id']}}</td>
                <td style="padding:10px;">{{ $articleOrder['articleOrder'][0]['heading']}}</td>
                <td style="padding:10px;">{{ $articleOrder['articleOrder'][0]['created_at']}}</td>
                <td style="padding:10px;text-align:right">{{ $articleOrder['articleOrder'][0]['price']}}</td>
                @php 
                    $total_article+=$articleOrder['articleOrder'][0]['price'];
                @endphp
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="padding:10px;"><strong><b>Total</b></strong></td>
                <td style="text-align:right"><span><b>${{$total_article}}</b></span></td>
            </tr>
        </tfoot>
    </table>
    <div style="clear:both;"></div>
    <br>
    <h3>Payment Details</h3>
    <table class="table" style="width:100%;" >
        <thead style="background:#3a3a3c;color:#ffff;">
            <tr>
                <th style="padding:10px;text-align:left">Summary</th>
                <th style="padding:10px;text-align:right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding:10px;">Subscriptions Total</td>
                <td style="padding:10px;text-align:right">${{$total_subscription}}</td>
            </tr>
            <tr>
                <td style="padding:10px;">Article Orders Total</td>
                <td style="padding:10px;text-align:right">${{$total_article}}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td style="padding:10px;"><strong><b>Total</b></strong></td>
                <td style="padding:10px; text-align:right"><span><b>${{ $total_article+$total_subscription }}</b></span></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>