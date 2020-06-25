@extends('layouts.app')

@section('title', 'E-SHOP-Tracking Page')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="tracking_info">
                <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <div class="content1">
                            <h2>Order ID: {{ $order_check->method_order_id }}</h2>
                        </div>
                        <div class="content2">
                            @php
                            $shipping_name = \App\Models\Admin\ShippingMethod::where('id', $order_check->shipping)->first();
                            @endphp
                            <div class="content2-header1">
                                <p>Shipped Via : <span>{{ $shipping_name->shipping_title }}</span></p>
                            </div>
                            <div class="content2-header1">
                                <p>Status :
                                    @if ($order_check->status == 0)
                                        <span class="badge badge-warning text-white p-1">Pending</span>
                                    @elseif ($order_check->status == 1)
                                        <span class="badge badge-info">Payment Confirm</span>
                                    @elseif ($order_check->status == 2)
                                        <span class="badge badge-primary">Processing</span>
                                    @elseif ($order_check->status == 3)
                                        <span class="badge badge-success">Delivered</span>
                                    @else
                                        <span class="badge badge-danger">Canceled</span>
                                    @endif
                                </p>
                            </div>
                            <div class="content2-header1">
                                @php
                                $delivery_time = explode(' ', $order_check->created_at);
                                $new_date = $delivery_time[0];
                                $new = date('d-M-Y', strtotime($new_date. ' + 14 days'));
                                $status = $order_check->status;
                                @endphp
                                <p>Expected Date : <span>{{ $new }}</span></p>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="content3">
                            <div class="shipment">
                                @if ($status == 0)
                                    <div class="confirm">
                                        <div class="imgcircle active_d">
                                            <img src="{{ asset('frontend/tracking_image/quality.png') }}" alt="quality check">
                                        </div>
                                        <span class="line"></span>
                                        <p>Pending Order</p>
                                    </div>
                                    <div class="quality">
                                        <div class="imgcircle">
                                            <img src="{{ asset('frontend/tracking_image/confirm.png') }}" alt="confirm order">
                                        </div>
                                        <span class="line"></span>
                                        <p>Confirmed Payment</p>
                                    </div>
                                    <div class="process">
                                        <div class="imgcircle">
                                            <img src="{{ asset('frontend/tracking_image/process.png') }}" alt="process order">
                                        </div>
                                        <span class="line"></span>
                                        <p>Processing Order</p>
                                    </div>
                                    <div class="dispatch">
                                        <div class="imgcircle">
                                            <img src="{{ asset('frontend/tracking_image/dispatch.png') }}" alt="dispatch product">
                                        </div>
                                        <span class="line"></span>
                                        <p>Dispatched Item</p>
                                    </div>
                                    <div class="delivery">
                                        <div class="imgcircle">
                                            <img src="{{ asset('frontend/tracking_image/delivery.png') }}" alt="delivery">
                                        </div>
                                        <p>Product Delivered</p>
                                    </div>

                                    @elseif ($status == 1)
                                        <div class="confirm">
                                            <div class="imgcircle active_d">
                                                <img src="{{ asset('frontend/tracking_image/quality.png') }}" alt="quality check">
                                            </div>
                                            <span class="line active_d"></span>
                                            <p>Pending Order</p>
                                        </div>
                                        <div class="quality">
                                            <div class="imgcircle active_d">
                                                <img src="{{ asset('frontend/tracking_image/confirm.png') }}" alt="confirm order">
                                            </div>
                                            <span class="line active_d"></span>
                                            <p>Confirmed Payment</p>
                                        </div>
                                        <div class="process">
                                            <div class="imgcircle">
                                                <img src="{{ asset('frontend/tracking_image/process.png') }}" alt="process order">
                                            </div>
                                            <span class="line"></span>
                                            <p>Processing Order</p>
                                        </div>
                                        <div class="dispatch">
                                            <div class="imgcircle">
                                                <img src="{{ asset('frontend/tracking_image/dispatch.png') }}" alt="dispatch product">
                                            </div>
                                            <span class="line"></span>
                                            <p>Dispatched Item</p>
                                        </div>
                                        <div class="delivery">
                                            <div class="imgcircle">
                                                <img src="{{ asset('frontend/tracking_image/delivery.png') }}" alt="delivery">
                                            </div>
                                            <p>Product Delivered</p>
                                        </div>

                                    @elseif ($status == 2)
                                        <div class="confirm">
                                            <div class="imgcircle active_d">
                                                <img src="{{ asset('frontend/tracking_image/quality.png') }}" alt="quality check">
                                            </div>
                                            <span class="line active_d"></span>
                                            <p>Pending Order</p>
                                        </div>
                                        <div class="quality">
                                            <div class="imgcircle active_d">
                                                <img src="{{ asset('frontend/tracking_image/confirm.png') }}" alt="confirm order">
                                            </div>
                                            <span class="line active_d"></span>
                                            <p>Confirmed Payment</p>
                                        </div>
                                        <div class="process">
                                            <div class="imgcircle active_d">
                                                <img src="{{ asset('frontend/tracking_image/process.png') }}" alt="process order">
                                            </div>
                                            <span class="line active_d"></span>
                                            <p>Processing Order</p>
                                        </div>
                                        <div class="dispatch">
                                            <div class="imgcircle">
                                                <img src="{{ asset('frontend/tracking_image/dispatch.png') }}" alt="dispatch product">
                                            </div>
                                            <span class="line"></span>
                                            <p>Dispatched Item</p>
                                        </div>
                                        <div class="delivery">
                                            <div class="imgcircle">
                                                <img src="{{ asset('frontend/tracking_image/delivery.png') }}" alt="delivery">
                                            </div>
                                            <p>Product Delivered</p>
                                        </div>

                                @elseif ($status == 3)
                                    <div class="confirm">
                                        <div class="imgcircle active_d">
                                            <img src="{{ asset('frontend/tracking_image/quality.png') }}" alt="quality check">
                                        </div>
                                        <span class="line active_d"></span>
                                        <p>Pending Order</p>
                                    </div>
                                    <div class="quality">
                                        <div class="imgcircle active_d">
                                            <img src="{{ asset('frontend/tracking_image/confirm.png') }}" alt="confirm order">
                                        </div>
                                        <span class="line active_d"></span>
                                        <p>Confirmed Payment</p>
                                    </div>
                                    <div class="process">
                                        <div class="imgcircle active_d">
                                            <img src="{{ asset('frontend/tracking_image/process.png') }}" alt="process order">
                                        </div>
                                        <span class="line active_d"></span>
                                        <p>Processing Order</p>
                                    </div>
                                    <div class="dispatch">
                                        <div class="imgcircle active_d">
                                            <img src="{{ asset('frontend/tracking_image/dispatch.png') }}" alt="dispatch product">
                                        </div>
                                        <span class="line active_d"></span>
                                        <p>Dispatched Item</p>
                                    </div>
                                    <div class="delivery">
                                        <div class="imgcircle active_d">
                                            <img src="{{ asset('frontend/tracking_image/delivery.png') }}" alt="delivery">
                                        </div>
                                        <p>Product Delivered</p>
                                    </div>
                                <div class="clearfix"></div>
                                    <div class="message text-center" style="margin-top: 25px;">
                                        <h3><span class="badge badge-success">Order Delivery Completed</span></h3>
                                    </div>
                                @else

                                @endif
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>

    <!-- Contact Form -->
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/tracking_style.css') }}">
    <style>
        .imgcircle.active_d {
            background-color:#0e8ce4;
        }
        span.line.active_d {
            background-color:#0e8ce4;
        }
        .imgcircle {
            background-color:#F5998E;
        }
        span.line {
            background-color:#F5998E;
        }
    </style>
@endsection

