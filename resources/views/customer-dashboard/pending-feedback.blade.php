@extends('layouts.app')
@section('title', 'E-SHOP - Pending Feedback')
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pending Product Feedback</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 order-lg-last dashboard-content pb-5">
                    <h2>Pending Product Feedback</h2>
                    <div class="mb-3"></div><!-- margin -->
                    <table class="table m-auto">
                        <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Order No</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($pending as $key => $val)
                            @if ($val->order->status == 3)
                                <tr>
                                    <td><img src="{{ asset($val->product->featured_image) }}" alt="{{ $val->product_name }}" width="50px" height="50px"></td>
                                    <td>{{ Str::limit($val->product_name, 20) }}</td>
                                    <td>{{ $val->quantity }}</td>
                                    <td>{{ $val->total_price }}</td>
                                    <td>${{ $val->order->method_order_id }}</td>
                                    <td>
                                        @if ($val->review == 0)
                                            <span class="badge badge-warning text-white p-1">Pending Review</span>
                                        @else
                                            <span class="badge badge-primary">Complete Review</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('customer.Product.feedback', [$val->product->slug, $val->order->id, Str::random(150)]) }}" class="btn badge-info" style="padding-top: 8px; padding-bottom: 8px;">Leave Feedback</a>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <td colspan="20" style="padding-top: 7%; padding-bottom: 5%;">
                                <h3 class="text-dark text-center">NO MORE PENDING REVIEW PRODUCT HERE</h3>
                                <div class="text-center pt-1">
                                    <a href="{{ route('shop.page') }}" class="btn btn-sm btn-info" >Order Now</a>
                                </div>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                    @if ($val->order->status == 3)
                    {{ $pending->links() }}
                    @else
                    @endif

                </div>
                @include('customer-dashboard/partials/sidebar')
            </div>
        </div>
        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->

@endsection
