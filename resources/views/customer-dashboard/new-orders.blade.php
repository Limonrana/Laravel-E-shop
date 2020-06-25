@extends('layouts.app')
@section('title', 'E-SHOP - Customer Orders')
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pending/Processing Order</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 order-lg-last dashboard-content pb-5">
                    <h2>Pending/Processing Order</h2>
                    <div class="mb-3"></div><!-- margin -->
                    <table class="table m-auto">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Order No</th>
                            <th scope="col">Tracking ID</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($new_orders as $key => $val)
                        <tr>
                            <td>{{ $new_orders->firstItem() + $key }}</td>
                            <td>
                                @if ($val->payment_type == 'stripe')
                                    {{ 'Stripe' }}
                                @elseif ($val->payment_type == '2checkout')
                                    {{ '2checkout' }}
                                @else
                                    {{ 'Paypal' }}
                                @endif
                            </td>
                            <td>{{ $val->method_order_id }}</td>
                            <td>{{ $val->tracking_number }}</td>
                            <td>${{ $val->order_amount }}</td>
                            <td>
                                @if ($val->status == 0)
                                    <span class="badge badge-warning text-white p-1">Pending/New</span>
                                @elseif ($val->status == 1)
                                    <span class="badge badge-primary">Confirm Payment</span>
                                @elseif ($val->status == 2)
                                    <span class="badge badge-info">Processing</span>
                                @else
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn badge-info" style="padding-top: 8px; padding-bottom: 8px;">View</a>
                            </td>
                        </tr>
                        @empty
                            <td colspan="20" style="padding-top: 7%; padding-bottom: 5%;">
                                <h3 class="text-dark text-center">NO MORE PENDING/PROCESSING ORDER HERE</h3>
                                <div class="text-center pt-1">
                                    <a href="{{ route('shop.page') }}" class="btn btn-sm btn-info" >Order Now</a>
                                </div>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $new_orders->links() }}

                </div>
                @include('customer-dashboard/partials/sidebar')
            </div>
        </div>
        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->

@endsection
