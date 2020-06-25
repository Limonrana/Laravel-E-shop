@extends('layouts.app')

@section('title', 'E-SHOP - Order Confirm')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order-Confirm</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container" style="width: 660px; background: #0088cc14; padding: 30px;">
            <div class="into text-center">
                <div class="my-image text-center">
                    <img src="{{ asset('frontend/images/checked-checkbox.png') }}" class="text-center d-inline">
                </div>
            <h1 class="light-title text-center" style="font-size: 40px">Thanks For Your <strong>Order</strong></h1>
                <p class="text-center" style="font-size: 18px;">
                    <b>Please check your email, You'll get Order Details in you email and also You'll receive an email when your items are shipped.</b>
                </p>
            </div>
            <div class="order pt-3">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 70%" class="pl-5">Order Number #</th>
                        <th scope="col" style="width: 10%"></th>
                        <th scope="col">{{ $order->method_order_id }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->order_details as $val)
                    <tr>
                        <td class="pl-5">{{ Str::limit($val->product_name, 40) }}</td>
                        <td>QTY: {{ $val->quantity }}</td>
                        <td>${{ $val->total_price }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="pl-5">Shipping Charge</td>
                        <td></td>
                        <td>${{ $order->shipping_all->shipping_charge }}</td>
                    </tr>
                    <tr>
                        <td class="pl-5">Sales Tax</td>
                        <td></td>
                        <td>$00.00</td>
                    </tr>
                    </tbody>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 70%" class="pl-5">Total</th>
                        <th scope="col" style="width: 10%"></th>
                        <th scope="col">${{ $order->order_amount }}</th>
                    </tr>
                    </thead>
                </table>
            </div>

            <div class="row pt-5 pl-5">
                <div class="col-md-6">
                    <h2 class="light-title">Billing <strong>Details</strong></h2>
                    @php
                    $state = \App\Models\Frontend\State::where('id', $order->ship_state)->first();
                    $country = \App\Models\Frontend\Country::where('id', $order->ship_country)->first();
                    @endphp
                    <div class="contact-info">
                        <div>
                            <span><b>Name:</b> {{ Auth::user()->name }}<br>
                                <b>Email:</b> {{ Auth::user()->email }} <br>
                                </span>
                        </div>
                    </div><!-- End .order-info -->
                </div><!-- End .col-md-6 -->

                <div class="col-md-6">
                    <h2 class="light-title">Shipping <strong>Details</strong></h2>

                    <div class="contact-info">
                        <div>
                            <span><b>Name :</b> {{ $order->ship_name }}<br>
                                <b>Email   :</b> {{ $order->ship_email }}<br>
                                <b>Phone   :</b> {{ $order->ship_phone }}<br>
                                <b>Address :</b> {{ $order->ship_address }}<br>
                                <b>City/State :</b> {{ $order->ship_city }} / {{ $state->name }}<br>
                                <b>Country/Zip :</b> {{ $country->name }} - {{ $order->ship_zip }}
                            </span>
                        </div>
                    </div><!-- End .order-info -->
                </div><!-- End .col-md-6 -->
            </div><!-- End .row -->

            <div class="button text-center">
                <a href="{{ route('home') }}" class="btn my-btn">GO to My Account</a>
                <a href="{{ route('shop.page') }}" class="btn btn-info">GO to Shop</a>
            </div>
        </div><!-- End .container -->

        <div class="mb-8"></div><!-- margin -->
    </main><!-- End .main -->
@endsection

@section('css')
    <style>
        .table .thead-dark th {
            color: #fff;
            background-color: #0088CC;
            border-color: #0088CC;
        }
        .my-btn {
            color: #fff;
            background-color: #0088CC;
            border-color: #0088CC;
        }
        .my-btn:hover {
            color: #fff;
            background-color: #29aeef;
            border-color: #29aeef;
        }
    </style>
@endsection
