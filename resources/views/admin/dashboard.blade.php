@extends('admin.layouts.app')
@section('title', 'E-SHOP - Admin Dashboard')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    @php
            $date = \Carbon\Carbon::today()->subDays(30);
            $product = \App\Models\Admin\Product::where('status', 1)->get();
            $inactive = \App\Models\Admin\Product::where('status', 0)->get();
            $category = \App\Models\Admin\Category::all();
            $sub = \App\Models\Admin\Subcategory::all();
            $brand = \App\Models\Admin\Brand::all();
            $customer = \App\User::all();
            $new_customer = \App\User::where('created_at','>=',$date)->get();
            $verified = \App\Models\Admin\Order::all();
            $out_of_stock = \App\Models\Admin\Product::where('product_quantity', 0)->get();
            $low_stock = \App\Models\Admin\Product::where('product_quantity', '<=', 5)->get();
            $high_stock = \App\Models\Admin\Product::where('product_quantity', '>=', 51)->get();
    @endphp
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Dashboard</span>
        </nav>

        <div class="sl-pagebody">

            <div class="row row-sm">
                <div class="col-sm-6 col-xl-3">
                    <div class="card pd-20 bg-primary">
                        <div class="d-flex justify-content-between align-items-center mg-b-10">
                            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Total Product</h6>
                            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                        </div><!-- card-header -->
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                            <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ count($product) }}</h3>
                        </div><!-- card-body -->
                        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                            <div>
                                <span class="tx-11 tx-white-6">Active</span>
                                <h6 class="tx-white mg-b-0">{{ count($product) }}</h6>
                            </div>
                            <div>
                                <span class="tx-11 tx-white-6">Inactive</span>
                                <h6 class="tx-white mg-b-0">{{ count($inactive) }}</h6>
                            </div>
                        </div><!-- -->
                    </div><!-- card -->
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
                    <div class="card pd-20 bg-info">
                        <div class="d-flex justify-content-between align-items-center mg-b-10">
                            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Category</h6>
                            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                        </div><!-- card-header -->
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                            <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ count($category) }}</h3>
                        </div><!-- card-body -->
                        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                            <div>
                                <span class="tx-11 tx-white-6">Sub-category</span>
                                <h6 class="tx-white mg-b-0">{{ count($sub) }}</h6>
                            </div>
                            <div>
                                <span class="tx-11 tx-white-6">Brand</span>
                                <h6 class="tx-white mg-b-0">{{ count($brand) }}</h6>
                            </div>
                        </div><!-- -->
                    </div><!-- card -->
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                    <div class="card pd-20 bg-danger">
                        <div class="d-flex justify-content-between align-items-center mg-b-10">
                            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Out of Stock</h6>
                            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                        </div><!-- card-header -->
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                            <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ count($out_of_stock) }}</h3>
                        </div><!-- card-body -->
                        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                            <div>
                                <span class="tx-11 tx-white-6">Low Stock</span>
                                <h6 class="tx-white mg-b-0">{{ count($low_stock) }}</h6>
                            </div>
                            <div>
                                <span class="tx-11 tx-white-6">High Stack</span>
                                <h6 class="tx-white mg-b-0">{{ count($high_stock) }}</h6>
                            </div>
                        </div><!-- -->
                    </div><!-- card -->
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                    <div class="card pd-20 bg-sl-primary">
                        <div class="d-flex justify-content-between align-items-center mg-b-10">
                            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Customer</h6>
                            <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                        </div><!-- card-header -->
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                            <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ count($customer) }}</h3>
                        </div><!-- card-body -->
                        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                            <div>
                                <span class="tx-11 tx-white-6">Total Order</span>
                                <h6 class="tx-white mg-b-0">{{ count($verified) }}</h6>
                            </div>
                            <div>
                                <span class="tx-11 tx-white-6">New</span>
                                <h6 class="tx-white mg-b-0">{{ count($new_customer) }}</h6>
                            </div>
                        </div><!-- -->
                    </div><!-- card -->
                </div><!-- col-3 -->
            </div><!-- row -->


            <!--
            ================================
            Customer List Start
            ================================
            -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">New Order</h6>
                        </div>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-5p">SL</th>
                            <th class="wd-15p">Customer Name</th>
                            <th class="wd-10p">Payment</th>
                            <th class="wd-15p">Order ID</th>
                            <th class="wd-15p">Transaction ID</th>
                            <th class="wd-10p">Order Amount</th>
                            <th class="wd-10p">Order Time</th>
                            <th class="wd-10p">Status</th>
                            <th class="wd-15">Action</th>
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
                                <td>{{ $val->method_order_id }}</td>
                                <td>{{ $val->transaction_id }}</td>
                                <td>${{ $val->order_amount }}</td>
                                <td>{{ $val->created_at ? $val->created_at->diffForHumans() : "N/A" }}</td>
                                <td>
                                    @if ($val->status == 0)
                                        <span class="badge badge-warning text-white p-1">Pending/New</span>
                                    @elseif ($val->status == 1)
                                        <span class="badge badge-info">Payment Confirm</span>
                                    @elseif ($val->status == 2)
                                        <span class="badge badge-primary">Processing</span>
                                    @else
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.edit.orders', $val->id) }}" class="btn btn-sm btn-info">View/Edit</a>
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
            </div><!-- card -->

            <!--
            ================================
            Customer List End
            ================================
            -->
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
@endsection
