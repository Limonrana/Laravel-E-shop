@extends('layouts.app')

@section('title', 'Dashboard - E-SHOP Customer')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-last dashboard-content">
                    <h2>My Dashboard</h2>
                    <div class="alert alert-success" role="alert">
                        Hello, <strong>{{ Auth::user()->name }}!</strong> From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.
                    </div><!-- End .alert -->

                    <div class="mb-4"></div><!-- margin -->

                    <h3>Account Information</h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Contact Information
                                    <a href="{{ route('customer.profile') }}" class="card-edit">Edit</a>
                                </div><!-- End .card-header -->

                                <div class="card-body">
                                    <p>
                                        {{ Auth::user()->name }}<br>
                                        {{ Auth::user()->email }}<br>
                                        {{ Auth::user()->phone }}<br>
                                        {{ Auth::user()->address_1 }}@if(Auth::user()->address_1), @else @endif {{ Auth::user()->city }}<br>
                                        {{ Auth::user()->state }} @if(Auth::user()->state), @else @endif {{ Auth::user()->country }} @if(Auth::user()->country)- @else @endif {{ Auth::user()->zip }}<br>
                                        <a href="{{ route('customer.profile') }}">Change Details</a>
                                    </p>
                                </div><!-- End .card-body -->
                            </div><!-- End .card -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    newsletters
                                    <a href="#" class="card-edit">Edit</a>
                                </div><!-- End .card-header -->

                                <div class="card-body">
                                    <p>
                                        You are currently not subscribed to any newsletter.
                                    </p>
                                </div><!-- End .card-body -->
                            </div><!-- End .card -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </div><!-- End .col-lg-9 -->
                @include('customer-dashboard/partials/sidebar')
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->
@endsection
