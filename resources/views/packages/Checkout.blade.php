@extends('layouts.app')

@section('title',"Checkout")

@section('styles')
<style>
    .StripeElement {
        background-color: white;
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
@endsection

@section('content')
    <div class="col-lg-12 py-3">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body ">
          <h2 class="login-box-msg h2 text-left text-primary px-0"><b>Checkout Plan</b></h2>
                @if (session('status'))
                    <div class="bg-success text-center text-white py-2 mb-3">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('package/process') }}" method="POST" id="subscribe-form">
                    @csrf
                    <span><b>Your Subscription is : {{ $plan->name }}</b></span> <span style="float:right"><b> GBP {{ $plan->amount != '' ? $plan->amount : '0' }}</b></span>
                    <!-- <div class="form-row my-2">
                        <label for="card-holder-amount">Card Holder Name</label>
                        <input id="card-holder-amount" name="amount" class="form-control" type="number">
                    </div> -->
                    <input type="hidden" name="plan_id" value="{{ $plan->plan_id != '' ? $plan->plan_id : '' }}">
                    <div class="form-row my-2">
                        <label for="card-holder-name">Card Holder Name</label>
                        <input id="card-holder-name" class="form-control" type="text">
                    </div>
                    <div class="form-row my-2">
                        <label for="card-element">Credit or debit card</label>
                        <div id="card-element" class="form-control">
                    </div>
                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                    <div class="stripe-errors"></div>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                        @endforeach
                    </div>
                    @endif
                    <div class="form-group text-center  mb-0">
                        <button  id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-success">PROCESS SUBSCRIPTION</button>
                    </div>
                </form>
        </div>
  </div>
<!-- /.login-box -->
</div>
@endsection

@section('javascript')
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    var card = elements.create('card', {hidePostalCode: true,
        style: style});
    card.mount('#card-element');
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;
    cardButton.addEventListener('click', async (e) => {
        e.preventDefault();
        console.log("attempting");
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: card,
                    billing_details: { name: cardHolderName.value }
                }
            }
            );
        if (error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
        } else {
            paymentMethodHandler(setupIntent.payment_method);
            
        }
    });
    function paymentMethodHandler(payment_method) {
        var form = document.getElementById('subscribe-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_method');
        hiddenInput.setAttribute('value', payment_method);
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>
@endsection