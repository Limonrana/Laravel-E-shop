@extends('admin.layouts.app')
@section('title', 'E-SHOP - E-commerce Dashboard')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->

    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">E-commerce</span>
            <span class="breadcrumb-item active">Dashboard</span>
        </nav>

        <div class="sl-pagebody">

            <div class="row row-sm">
                <div class="col-sm-6 col-xl-3">
                    <div class="card pd-20 bg-primary">
                        <div class="d-flex justify-content-between align-items-center mg-b-10">
                            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Today's Sales</h6>
                            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                        </div><!-- card-header -->
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                            <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{ $today_amount }}</h3>
                        </div><!-- card-body -->
                        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                            <div>
                                @php
                                    $order_today = count($today_order);
                                    $gross_today = $today_amount * $order_today / 100;
                                @endphp
                                <span class="tx-11 tx-white-6">Gross Sales</span>
                                <h6 class="tx-white mg-b-0">${{ round($gross_today, 2) }}</h6>
                            </div>
                            <div>
                                <span class="tx-11 tx-white-6">Total Order</span>
                                <h6 class="tx-white mg-b-0 text-center">{{ count($today_order) }}</h6>
                            </div>
                        </div><!-- -->
                    </div><!-- card -->
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
                    <div class="card pd-20 bg-info">
                        <div class="d-flex justify-content-between align-items-center mg-b-10">
                            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Week's Sales</h6>
                            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                        </div><!-- card-header -->
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                            <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{ $weekly_amount }}</h3>
                        </div><!-- card-body -->
                        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                            <div>
                                @php
                                    $order_weekly = count($weekly_order);
                                    $gross_weekly = $weekly_amount * $order_weekly / 100;
                                @endphp
                                <span class="tx-11 tx-white-6">Gross Sales</span>
                                <h6 class="tx-white mg-b-0">${{ round($gross_weekly, 2) }}</h6>
                            </div>
                            <div>
                                <span class="tx-11 tx-white-6">Total Order</span>
                                <h6 class="tx-white mg-b-0 text-center">{{ count($weekly_order) }}</h6>
                            </div>
                        </div><!-- -->
                    </div><!-- card -->
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                    <div class="card pd-20 bg-purple">
                        <div class="d-flex justify-content-between align-items-center mg-b-10">
                            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Month's Sales</h6>
                            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                        </div><!-- card-header -->
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                            <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{ $monthly_amount }}</h3>
                        </div><!-- card-body -->
                        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                            <div>
                                <span class="tx-11 tx-white-6">Gross Sales</span>
                                @php
                                    $order_month = count($today_order);
                                    $gross_month = $monthly_amount * $order_month / 100;
                                @endphp
                                <h6 class="tx-white mg-b-0">${{ round($gross_month, 2) }}</h6>
                            </div>
                            <div>
                                <span class="tx-11 tx-white-6">Total Order</span>
                                <h6 class="tx-white mg-b-0 text-center">{{ count($monthly_order) }}</h6>
                            </div>
                        </div><!-- -->
                    </div><!-- card -->
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                    <div class="card pd-20 bg-sl-primary">
                        <div class="d-flex justify-content-between align-items-center mg-b-10">
                            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Year's Sales</h6>
                            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                        </div><!-- card-header -->
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                            <h3 class="mg-b-0 tx-white tx-lato tx-bold">${{ $year_amount }}</h3>
                        </div><!-- card-body -->
                        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                            <div>
                                @php
                                    $order_year = count($year_order);
                                    $gross_year = $year_amount * $order_year / 100;
                                @endphp
                                <span class="tx-11 tx-white-6">Gross Sales</span>
                                <h6 class="tx-white mg-b-0">${{ round($gross_year, 2) }}</h6>
                            </div>
                            <div>
                                <span class="tx-11 tx-white-6">Total Order</span>
                                <h6 class="tx-white mg-b-0 text-center">{{ count($year_order) }}</h6>
                            </div>
                        </div><!-- -->
                    </div><!-- card -->
                </div><!-- col-3 -->
            </div><!-- row -->

            <div class="row row-sm mg-t-20">
                <div class="col-xl-12 mg-t-20 mg-xl-t-0">

                    <div class="card overflow-hidden">
                        <div class="card-header bg-transparent pd-y-20 d-sm-flex align-items-center justify-content-between">
                            <div class="mg-b-20 mg-sm-b-0">
                                <h6 class="card-title mg-b-5 tx-13 tx-uppercase tx-bold tx-spacing-1">Monthly Analytics</h6>
                            </div>
                        </div><!-- card-header -->
                        <div class="card-body pd-0 bd-color-gray-lighter">
                            <div class="row no-gutters tx-center">
                                <div class="col-12 col-sm-4 pd-y-20 tx-left">
                                    <p class="pd-l-20 tx-12 lh-8 mg-b-0">Note: Only last 30 days all data.</p>
                                </div><!-- col-4 -->
                                <div class="col-6 col-sm-2 pd-y-20">
                                    <h4 class="tx-inverse tx-lato tx-bold mg-b-5">${{ $monthly_amount }}</h4>
                                    <p class="tx-11 mg-b-0 tx-uppercase">Total Sales</p>
                                </div><!-- col-2 -->
                                <div class="col-6 col-sm-2 pd-y-20 bd-l">
                                    <h4 class="tx-inverse tx-lato tx-bold mg-b-5">{{ count($monthly_order) }}</h4>
                                    <p class="tx-11 mg-b-0 tx-uppercase">Total Order</p>
                                </div><!-- col-2 -->
                                <div class="col-6 col-sm-2 pd-y-20 bd-l">
                                    <h4 class="tx-inverse tx-lato tx-bold mg-b-5">{{ count($new_user) }}</h4>
                                    <p class="tx-11 mg-b-0 tx-uppercase">New Customer</p>
                                </div><!-- col-2 -->
                                <div class="col-6 col-sm-2 pd-y-20 bd-l">
                                    <h4 class="tx-inverse tx-lato tx-bold mg-b-5">${{ $refund }}</h4>
                                    <p class="tx-11 mg-b-0 tx-uppercase">Refunded</p>
                                </div><!-- col-2 -->
                            </div><!-- row -->
                        </div><!-- card-body -->
                        <div class="card-body pd-0">
                            <div id="rickshaw2" class="wd-100p ht-200"></div>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col-6 -->
            </div><!-- row -->


            <div class="row row-sm mg-t-20">
                <div class="col-xl-12">
                    <div class="card overflow-hidden">
                        <div class="card-header bg-transparent pd-y-20 d-sm-flex align-items-center justify-content-between">
                            <div class="mg-b-20 mg-sm-b-0">
                                <h6 class="card-title mg-b-5 tx-13 tx-uppercase tx-bold tx-spacing-1">Total Orders</h6>
                            </div>
                        </div><!-- card-header -->
                        <div class="card-body pd-0 bd-color-gray-lighter">
                            <div class="no-gutters tx-center">
                                <div class="table-wrapper">
                                    <table id="datatable1" class="table display responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th class="wd-5p text-center">SL</th>
                                            <th class="wd-15p text-center">Customer Name</th>
                                            <th class="wd-10p text-center">Payment</th>
                                            <th class="wd-10 text-center">Shipping Method</th>
                                            <th class="wd-15p text-center">Order ID</th>
                                            <th class="wd-15p text-center">Transaction ID</th>
                                            <th class="wd-10p text-center">Order Amount</th>
                                            <th class="wd-10p text-center">Order Time</th>
                                            <th class="wd-10p text-center">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($order as $key => $val)
                                            <tr>
                                                <td>{{ $order->firstItem() + $key }}</td>
                                                <td>{{ $val->user->name }}</td>
                                                <td>
                                                    @if ($val->payment_type == 'credit')
                                                        {{ 'Stripe' }}
                                                    @elseif ($val->payment_type == 'ideal')
                                                        {{ 'Ideal Pay' }}
                                                    @else
                                                        {{ 'Paypal' }}
                                                    @endif
                                                </td>
                                                <td>{{ $val->shipping }}</td>
                                                <td>{{ $val->method_order_id }}</td>
                                                <td>{{ $val->transaction_id }}</td>
                                                <td>${{ $val->order_amount }}</td>
                                                <td>{{ $val->created_at ? $val->created_at->diffForHumans() : "N/A" }}</td>
                                                <td>
                                                    @if ($val->status == 0)
                                                        <span class="badge badge-warning text-white p-1">Pending</span>
                                                    @elseif ($val->status == 1)
                                                        <span class="badge badge-info">Payment Confirm</span>
                                                    @elseif ($val->status == 2)
                                                        <span class="badge badge-primary p-1">Processing</span>
                                                    @elseif ($val->status == 3)
                                                        <span class="badge badge-success">Delivery Complete</span>
                                                    @else
                                                        <span class="badge badge-danger">Cancel/Refund</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <td colspan="20" style="padding-top: 15%; padding-bottom: 15%;">
                                                <h3 class="text-dark text-center">NO MORE NEW ORDER HERE</h3>
                                                <div class="text-center pt-3">
                                                    <a href="{{ route('admin.product.add.new') }}" class="btn btn-md btn-info" >Total Orders</a>
                                                </div>
                                            </td>
                                        @endforelse
                                        </tbody>
                                    </table>
                                    {{ $order->links() }}
                                </div><!-- table-wrapper -->
                            </div><!-- row -->
                        </div><!-- card-body -->
                    </div><!-- card -->

                </div><!-- col-12 -->
            </div><!-- row -->
            @include('admin.partials.copyright')
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
