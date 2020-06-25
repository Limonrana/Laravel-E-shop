@extends('layouts.app')

@section('title', 'E-SHOP - Checkout Page')

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
                <li class="active">
                    <span>Shipping</span>
                </li>
                <li>
                    <span>Review &amp; Payments</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-lg-8">
                    <ul class="checkout-steps">
                        <li>
                            <h2 class="step-title">Shipping Address</h2>
                            <form action="{{ route('order.page') }}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group required-field col-md-6">
                                        <label>Shipping Name </label>
                                        <input type="text" class="form-control" name="ship_name" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-group required-field col-md-6">
                                        <label>Phone Number </label>
                                        <div class="form-control-tooltip">
                                            <input type="text" name="ship_phone" maxlength="14" onkeypress="return isNumberKey(event)" class="form-control" required placeholder="Example: 08898789876">
                                            <span class="input-tooltip" data-toggle="tooltip" title="For delivery questions." data-placement="right"><i class="icon-question-circle"></i></span>
                                        </div><!-- End .form-control-tooltip -->
                                    </div><!-- End .form-group -->
                                </div>
                                <div class="form-group required-field">
                                    <label>Shipping Email </label>
                                    <input type="email" name="ship_email" class="form-control" required>
                                </div><!-- End .form-group -->
                                <div class="form-row">
                                    <div class="form-group required-field col-md-6">
                                        <label>Street Address </label>
                                        <input type="text" class="form-control" name="ship_address" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-group col-md-6">
                                        <label>Street Address 2 (optional)</label>
                                        <input type="text" class="form-control" name="ship_address_2">
                                    </div><!-- End .form-group -->
                                </div>

                                <div class="form-row">
                                    <div class="form-group required-field col-md-6">
                                        <label>City  </label>
                                        <input type="text" class="form-control" name="ship_city" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-group required-field col-md-6">
                                        <label>Zip/Postal Code </label>
                                        <input type="text" class="form-control" name="ship_zip" required>
                                    </div><!-- End .form-group -->
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="ship_country">Country</label>
                                        <div class="select-custom">
                                            <select class="form-control" id="ship_country" name="ship_country">
                                                <option>Choose Country</option>
                                                @foreach($country as $val)
                                                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                                                @endforeach
                                            </select>
                                        </div><!-- End .select-custom -->
                                    </div><!-- End .form-group -->

                                    <div class="form-group col-md-6">
                                        <label for="ship_state">State/Province</label>
                                        <div class="select-custom">
                                            <select class="form-control" id="ship_state" name="ship_state">
                                                <option>Choose State</option>
                                            </select>
                                        </div><!-- End .select-custom -->
                                    </div><!-- End .form-group -->
                                </div>
                        </li>
                    </ul>
                </div><!-- End .col-lg-8 -->

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
                    <ul class="checkout-steps">
                        <li>
                            <div class="checkout-step-shipping">
                                <h2 class="step-title">Shipping Methods</h2>

                                <table class="table table-step-shipping">
                                    <tbody>
                                    @foreach($shipping as $val)
                                    <tr>
                                        <td><input type="radio" name="shipping" value="{{ $val->id }}"></td>
                                        <td><strong>${{ $val->shipping_charge }}</strong></td>
                                        <td>
                                            {{ $val->shipping_title }}
                                            <br>
                                            {{ $val->shipping_time }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- End .checkout-step-shipping -->
                        </li>
                    </ul>
                    <div class="payment-methods mb-4 text-center">
                        <img src="{{ asset('frontend/images/payments.png') }}" class="text-center" style="display: inline-block;" alt="payment method">
                    </div>
                    <div class="checkout-steps-action">
                        <button type="submit" class="btn btn-primary btn-block">GO TO NEXT STEP</button>
                    </div><!-- End .checkout-steps-action -->
                </div><!-- End .col-lg-4 -->
                </form>
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-6"></div><!-- margin -->
    </main><!-- End .main -->
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#ship_country').change(function () {
                var CountryID = $(this).val();
                if (CountryID) {
                    $.ajax({
                        type: "GET",
                        url: '/api/get_state/' + CountryID,
                        data_type: "json",
                        success: function (data) {
                            //console.log(data);
                            if (data) {
                                $('#ship_state').empty();
                                $.each(data, function (key, value) {
                                    $('#ship_state').append('<option value="' + value.id + '">' + value.name + '</option>');
                                })
                            }
                        }
                    })
                }
            });

            // $('#ship_state').change(function () {
            //     var stateID = $(this).val();
            //     if (stateID) {
            //         $.ajax({
            //             type: "GET",
            //             url: '/api/get_city/' + stateID,
            //             data_type: "json",
            //             success: function (data) {
            //                 //console.log(data);
            //                 if (data) {
            //                     $('select[name="ship_city"]').empty();
            //                     $.each(data, function (key, value) {
            //                         $('select[name="ship_city"]').append('<option value="'+value.id+'">'+value.name+'</option>');
            //                     })
            //                 }
            //             }
            //         })
            //     }
            // });
        });

        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
@endsection
