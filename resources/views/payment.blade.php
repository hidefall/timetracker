@extends('layouts.clean')

@section('content')
    <div class="container">
        <div class="row">
            @if(!request('plan'))
            <div class="col-md-6">
                <div class="panel panel-default text-center">
                    <div class="panel-body">
                        <form method="get" action="/payment/micro">
                            <h3>Micro</h3>
                            <p>9,99$</p>
                            <ul>
                                <li>Benefit #1</li>
                                <li>Benefit #2</li>
                                <li>Benefit #3</li>
                                <li>Benefit #4</li>
                                <li>Benefit #5</li>
                            </ul>
                            <button type="submit" class="btn btn-success btn-block">Choose</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default text-center">
                    <div class="panel-body">
                        <form method="get" action="/payment/standard">
                            <h3>Standard</h3>
                            <p>99,99$</p>
                            <ul>
                                <li>Benefit #1</li>
                                <li>Benefit #2</li>
                                <li>Benefit #3</li>
                                <li>Benefit #4</li>
                                <li>Benefit #5</li>
                            </ul>
                            <button type="submit" class="btn btn-success btn-block">Choose</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @if(request('plan'))
                    <form action="/napi/subscribe" method="post" id="payment-form">
                        @csrf
                        <div class="form-row">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <input type="hidden" name="plan" value="{{ request('plan') }}" />
                        <input type="hidden" name="type" value="from_php" />
                        <button>Submit Payment</button>
                    </form>
            @endif
        </div>
    </div>
@endsection

@section('adminlte_js')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('pk_test_Y76tdFx8EtjbaE4sStat4AMY');
        var elements = stripe.elements();

        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
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

        var card = elements.create('card', {style: style});
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });
    </script>
@endsection

@section('adminlte_css')
    <style>
    /**
    * The CSS shown here will not be introduced in the Quickstart guide, but shows
    * how you can use CSS to style your Element's container.
    */
    .StripeElement {
    background-color: white;
    height: 40px;
    padding: 10px 12px;
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