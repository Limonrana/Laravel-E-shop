@extends('layouts.app')

@section('title', 'Billing - E-SHOP Customer')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Billing Address</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-last dashboard-content">
                    <h2>My Billing Address</h2>
                    <div class="alert alert-success" role="alert">
                        Hello, <strong>{{ Auth::user()->name }}!</strong> From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.
                    </div><!-- End .alert -->

                    <div class="mb-4"></div><!-- margin -->
                    <h3>Billing Information</h3>

                    <div class="card">
                        <div class="card-header">
                            Address Book
                            <a href="{{ route('customer.profile') }}" class="card-edit">Edit</a>
                        </div><!-- End .card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="">Default Billing Address</h4>
                                    <address>
                                        {{ Auth::user()->name }}<br>
                                        {{ Auth::user()->email }}<br>
                                        {{ Auth::user()->phone }}<br>
                                        {{ Auth::user()->address_1 }}, {{ Auth::user()->city }}<br>
                                        {{ Auth::user()->state }}, {{ Auth::user()->country }}-{{ Auth::user()->zip }}<br>
                                        <a href="{{ route('customer.profile') }}">Edit Address</a>
                                    </address>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="">Default Shipping Address</h4>
                                    <address>
                                        {{ Auth::user()->name }}<br>
                                        {{ Auth::user()->email }}<br>
                                        {{ Auth::user()->phone }}<br>
                                        {{ Auth::user()->address_1 }}, {{ Auth::user()->city }}<br>
                                        {{ Auth::user()->state }}, {{ Auth::user()->country }}-{{ Auth::user()->zip }}<br>
                                        <a href="{{ route('customer.profile') }}">Edit Address</a>
                                    </address>
                                </div>
                            </div>
                        </div><!-- End .card-body -->
                    </div><!-- End .card -->
                </div><!-- End .col-lg-9 -->
                @include('customer-dashboard/partials/sidebar')
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->
@endsection
