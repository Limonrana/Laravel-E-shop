@extends('layouts.app')

@section('title', 'E-SHOP - Payment Page')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <ul class="checkout-progress-bar">
                <li>
                    <span>Shipping</span>
                </li>
                <li class="active">
                    <span>Review &amp; Payments</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-lg-4">
                    <div class="order-summary">
                        <h3>Summary</h3>

                        <h4>
                            <a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button" aria-expanded="false" aria-controls="order-cart-section">{{ count($cart) }} products in Cart</a>
                        </h4>

                        <div class="collapse" id="order-cart-section">
                            <table class="table table-mini-cart">
                                <tbody>
                                @forelse($cart as $val)
                                    <tr>
                                        <td class="product-col">
                                            <figure class="product-image-container">
                                                <a href="{{ route('single.product.view', [$val->options->slug, Str::random(150)]) }}" target="_blank" class="product-image">
                                                    <img src="{{ asset($val->options->image) }}" alt="product">
                                                </a>
                                            </figure>
                                            <div>
                                                <h2 class="product-title">
                                                    <a href="{{ route('single.product.view', [$val->options->slug, Str::random(150)]) }}" target="_blank">
                                                        {{ Str::limit($val->name, 20) }}
                                                    </a>
                                                </h2>

                                                <span class="product-qty">Qty: {{ $val->qty }}</span>
                                            </div>
                                        </td>
                                        <td class="price-col">${{ $val->price }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="product-col">
                                            <h3>Your cart product is empty.</h3>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div><!-- End #order-cart-section -->
                    </div><!-- End .order-summary -->

                    <div class="checkout-info-box">
                        <h3 class="step-title">Ship To:
                            <a href="#" title="Edit" class="step-title-edit"><span class="sr-only">Edit</span><i class="icon-pencil"></i></a>
                        </h3>

                        <address>
                            @if (Session::has('order'))
                                @php
                                    $ship_id = session()->get('order')['shipping'];
                                    $country_id = session()->get('order')['ship_country'];
                                    $state_id = session()->get('order')['ship_state'];
                                    $shipping = \App\Models\Admin\ShippingMethod::where('id', $ship_id)->first();
                                    $country = \App\Models\Frontend\Country::where('id', $country_id)->first();
                                    $state = \App\Models\Frontend\State::where('id', $state_id)->first();
                                @endphp
                                Shipping Name   : <b>{{ session()->get('order')['ship_name'] }}</b> <br>
                                Shipping Email  : <b>{{ session()->get('order')['ship_email'] }}</b> <br>
                                Shipping Phone  : <b>{{ session()->get('order')['ship_phone'] }}</b> <br>
                                Shipping Address: <b>{{ session()->get('order')['ship_address'] }}</b> <br>
                                Shipping City   : <b>{{ session()->get('order')['ship_city'] }}</b> <br>
                                Shipping state  : <b>{{ $state->name }}</b> <br>
                                Country/Zip     : <b>{{ $country->name }} - {{ session()->get('order')['ship_zip'] }}</b> <br>
                            @else
                            @endif
                        </address>
                    </div><!-- End .checkout-info-box -->

                    <div class="checkout-info-box">
                        <h3 class="step-title">Shipping Method:
                            <a href="#" title="Edit" class="step-title-edit"><span class="sr-only">Edit</span><i class="icon-pencil"></i></a>
                        </h3>
                        @php
                            $ship_id = session()->get('order')['shipping'];
                            $shipping = \App\Models\Admin\ShippingMethod::where('id', $ship_id)->first();
                        @endphp
                        <p>{{ $shipping->shipping_title }} - ${{ $shipping->shipping_charge }}</p>
                    </div><!-- End .checkout-info-box -->
                </div><!-- End .col-lg-4 -->

                <div class="col-lg-8 order-lg-first">

                    <ul class="checkout-steps">
                        <li>
                            <h2 class="step-title">Order Details</h2>

                            <div class="shipping-step-addresses">
                                <div class="shipping-address-box active">
                                    <div class="h4">Order</div>
                                    <address>
                                        @if (Session::has('order'))
                                            @php
                                            $ship_id = session()->get('order')['shipping'];
                                            $shipping = \App\Models\Admin\ShippingMethod::where('id', $ship_id)->first();
                                            @endphp
                                            Billing Name   : <b>{{ Auth::user()->name }}</b> <br>
                                            Billing Email  : <b>{{ Auth::user()->email }}</b> <br>
                                            Billing Phone  : <b>{{ Auth::user()->phone }}</b> <br>
                                            Billing Address: <b>{{ Auth::user()->address_1 }}</b> <br>
                                            Billing City   : <b>{{ Auth::user()->city }}</b> <br>
                                            Billing state  : <b>{{ Auth::user()->state }}</b> <br>
                                            Country/Zip    : <b>{{ Auth::user()->country }}-{{ Auth::user()->zip }}</b> <br>
                                            Shipping Method: <b>{{ $shipping->shipping_title }}</b> <br>
                                            Shipping Charge: <b>${{ $shipping->shipping_charge }}</b> <br>
                                            Total Amount   : <b>${{ session()->get('order')['total'] }}</b> <br>
                                        @else
                                        @endif
                                    </address>
                                </div><!-- End .shipping-address-box -->
                            </div><!-- End .shipping-step-addresses -->
                        </li>
                    </ul>

                    <form action="{{ route('order.payment') }}" method="post" id="payment-form">
                        @csrf
                    <div class="checkout-payment">
                        <ul class="checkout-steps">
                            <li>
                                <div class="checkout-step-shipping">
                                    <h2 class="step-title">Payment Methods:</h2>

                                    <table class="table table-step-shipping">
                                        <tbody>
                                        <tr>
                                            <td><input type="radio" id="stripe" name="payment_type" value="stripe" checked></td>
                                            <td><strong>Stripe</strong></td>
                                            <td>Credit Or Debit Card</td>
                                        </tr>

                                        <tr>
                                            <td><input type="radio" id="2Checkout" name="payment_type" value="2Checkout"></td>
                                            <td><strong>2Checkout</strong></td>
                                            <td>Paypal/Credit and Debit Card</td>
                                        </tr>
                                        <tr>
                                            <td><input type="radio" id="paypal" name="payment_type" value="paypal"></td>
                                            <td><strong>Paypal</strong></td>
                                            <td>Paypal/Credit and Debit Card</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div><!-- End .checkout-step-shipping -->
                            </li>
                        </ul>
                        <div id="formstripe" class="pay_form">
                             <!-- STRIPE PAYMENT START -->
                             <div class="credit" id="credit_card_form">
                                  <label for="card-element">
                                      Credit or debit card
                                  </label>
                                  <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                  </div>
                                   <!-- Used to display form errors. -->
                                  <div id="card-errors" role="alert"></div>
                             </div>
                            <!-- STRIPE PAYMENT END -->
                        </div><!-- End #checkout-shipping-address -->


                            <div id="form2Checkout" class="pay_form">
                                <div class="form-row">
                                    <div class="form-group required-field col-md-7">
                                        <label for="cc-number">Card Number</label>
                                        <input type="text" class="form-control" id="cc-number" maxlength="16" onkeypress="return isNumberKey(event)" placeholder="Debit/Credit Card Number">
                                    </div><!-- End .form-group -->
                                    <div class="form-group col-md-5">
                                        <label for="cc-expiration">CVV</label>
                                        <input type="text" class="form-control" id="cc-cvv" placeholder="Security Code" maxlength="3" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="my-label">
                                            <label>Expiration</label>
                                        </div>
                                        <div class="select-custom">
                                            <select name='expireMM' class="form-control" id='expireMM'>
                                                <option value=''>Month</option>
                                                <option value='01'>January</option>
                                                <option value='02'>February</option>
                                                <option value='03'>March</option>
                                                <option value='04'>April</option>
                                                <option value='05'>May</option>
                                                <option value='06'>June</option>
                                                <option value='07'>July</option>
                                                <option value='08'>August</option>
                                                <option value='09'>September</option>
                                                <option value='10'>October</option>
                                                <option value='11'>November</option>
                                                <option value='12'>December</option>
                                            </select>
                                        </div><!-- End .select-custom -->
                                    </div><!-- End .form-group -->

                                    <div class="form-group col-md-6">
                                        <div class="my-label pt-2">
                                            <label></label>
                                        </div>
                                        <div class="select-custom">
                                            <select name='expireYY' class="form-control" id='expireYY'>
                                                <option value=''>Year</option>
                                                <option value='20'>2020</option>
                                                <option value='21'>2021</option>
                                                <option value='22'>2022</option>
                                                <option value='23'>2023</option>
                                                <option value='24'>2024</option>
                                                <option value='25'>2025</option>
                                                <option value='26'>2026</option>
                                                <option value='27'>2027</option>
                                                <option value='28'>2028</option>
                                                <option value='29'>2029</option>
                                                <option value='30'>2030</option>
                                            </select>
                                        </div><!-- End .select-custom -->
                                    </div>
                                </div>
                            </div><!-- End #checkout-shipping-address -->

                            <div id="formpaypal" class="pay_form">
                                <div class="alert alert-success" role="alert">
                                    <strong>Pay via PayPal,</strong> you can pay with your credit card if you don’t have a PayPal account.
                                </div><!-- End .alert -->
                            </div><!-- End #checkout-shipping-address -->
                            <div class="clearfix">
                                <button class="btn btn-primary float-right mt-3">Place Order</button>
                            </div><!-- End .clearfix -->
                    </div><!-- End .checkout-payment -->
                    </form>
                    <div class="pay_all">
                    </div>
                </div><!-- End .col-lg-8 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-6"></div><!-- margin -->
    </main><!-- End .main -->
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/payment/css/stripe.css') }}">
@endsection

@section('js')
    <script src="https://js.stripe.com/v3/"></script>
{{--        <script src="{{ asset('frontend/payment/js/stripe.js') }}"></script>--}}
    <script>
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#formstripe').show();
            $('#form2Checkout').hide();
            $('#formpaypal').hide();
            $("input[name$='payment_type']").click(function() {
                var test = $(this).val();
                $("div.pay_form").hide();
                $("#form" + test).show();
            });
        });
    </script>

    <script>
        // Create a Stripe client.
        var stripe = Stripe('{{env("STRIPE_KEY")}}');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
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

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
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

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }

    </script>
@endsection
