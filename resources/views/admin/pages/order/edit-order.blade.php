@extends('admin.layouts.app')
@section('title', 'Edit Order | E-SHOP')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">E-SHOP</a>
            <span class="breadcrumb-item active">Edit Order</span>
        </nav>
        <div class="sl-pagebody">
            <div class="row row-sm mg-t-20">
                <div class="col-xl-6">
                    <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                        <h6 class="card-body-title">
                            Order Details
                            <span class="float-right" style="margin-top: -30px;">
                                <img src="{{ asset($order_details->user->avatar ? $order_details->user->avatar : 'uploads/no-image/no-user.png') }}" width="50px" style="border-radius: 100%">
                            </span>
                        </h6>
                        <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                                <thead>
                                <tr>
                                    <th class="wd-40p">Name : </th>
                                    <th class="wd-60p">{{ $order_details->user->name }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Email :</th>
                                    <th class="wd-60p">{{ $order_details->user->email }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Phone :</th>
                                    <th class="wd-60p">{{ $order_details->user->phone }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Payment :</th>
                                    <th class="wd-60p">
                                        @if ($order_details->payment_type == 'stripe')
                                            {{ 'Stripe' }}
                                        @elseif ($order_details->payment_type == '2checkout')
                                            {{ '2checkout' }}
                                        @else
                                            {{ 'Paypal' }}
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Order ID :</th>
                                    <th class="wd-60p">{{ $order_details->method_order_id }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Transaction ID :</th>
                                    <th class="wd-60p">{{ $order_details->transaction_id }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Tacking ID :</th>
                                    <th class="wd-60p">{{ $order_details->tracking_number }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Order Date :</th>
                                    <th class="wd-60p">{{ $order_details->created_at }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Total :</th>
                                    <th class="wd-60p">${{ $order_details->order_amount }}</th>
                                </tr>
                                </thead>
                            </table>
                            <div class="button float-right">
                                @if ($order_details->status == 0)
                                    <a href="{{ route('admin.confirm.order', $order_details->id) }}" class="btn btn-success">Accept Payment</a>
                                    <a href="{{ route('admin.hold.order', $order_details->id) }}" class="btn btn-danger" id="cancel">On-Hold</a>
                                @elseif ($order_details->status == 1)
                                    <a href="{{ route('admin.processing.order', $order_details->id) }}" class="btn btn-success">Processing</a>
                                    <a href="{{ route('admin.hold.order', $order_details->id) }}" class="btn btn-danger" id="cancel">On-Hold</a>
                                @elseif ($order_details->status == 2)
                                    <a href="{{ route('admin.complete.order', $order_details->id) }}" class="btn btn-success">Complete</a>
                                    <a href="{{ route('admin.hold.order', $order_details->id) }}" class="btn btn-danger" id="cancel">On-Hold</a>
                                @elseif ($order_details->status == 3)
                                    <span class="badge badge-success">Delivery Done</span>
                                @elseif ($order_details->status == 4)
                                    <a href="{{ route('admin.confirm.order', $order_details->id) }}" class="btn btn-success">Order Active</a>
                                @else
                                @endif
                            </div>
                        </div>
                    </div><!-- card -->
                </div><!-- col-6 -->
                <div class="col-xl-6 mg-t-25 mg-xl-t-0">
                    <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
                        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Shipping Details</h6>
                        <div class="table-wrapper">
                            <table id="datatable1" class="table display responsive nowrap">
                                <thead>
                                <tr>
                                    <th class="wd-40p">Ship Name : </th>
                                    <th class="wd-60p">{{ $order_details->ship_name }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Ship Email :</th>
                                    <th class="wd-60p">{{ $order_details->ship_email }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Ship Phone :</th>
                                    <th class="wd-60p">{{ $order_details->ship_phone }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Ship Address :</th>
                                    <th class="wd-60p">{{ $order_details->ship_address }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Ship City :</th>
                                    <th class="wd-60p">{{ $order_details->ship_city }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Ship Country :</th>
                                    <th class="wd-60p">{{ $country->name }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Ship State/Zip :</th>
                                    <th class="wd-60p">{{ $state->name }} / {{ $order_details->ship_zip }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Shipping Method :</th>
                                    <th class="wd-60p">{{ $shipping_d->shipping_title }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Tracking ID :</th>
                                    <th class="wd-60p">{{ $order_details->tracking_number }}</th>
                                </tr>
                                <tr>
                                    <th class="wd-40p">Status :</th>
                                    <th class="wd-60p text-bold">
                                        <span style="font-size: 14px">
                                            @if ($order_details->refund == 0)
                                                @if ($order_details->status == 0)
                                                    <span class="badge badge-warning text-white p-1">Pending</span>
                                                @elseif ($order_details->status == 1)
                                                    <span class="badge badge-info">Confirm Payment</span>
                                                @elseif ($order_details->status == 2)
                                                    <span class="badge badge-primary">Processing</span>
                                                @elseif ($order_details->status == 3)
                                                    <span class="badge badge-success">Delivery Complete</span>
                                                @else
                                                    <span class="badge badge-danger">On-Hold</span>
                                                @endif
                                            @else
                                                <span class="badge badge-danger">Refunded</span>
                                            @endif

                                        </span>
                                    </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div><!-- card -->
                </div><!-- col-6 -->
            </div><!-- row -->

            <div class="row-sm mg-t-20 pl-2 pr-2">
            <div class="card pd-20 pd-sm-40">
                <div class="col-md-12">

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-5p">SL</th>
                            <th class="wd-10p">Image</th>
                            <th class="wd-30p">Product name</th>
                            <th class="wd-10p">Product Code</th>
                            <th class="wd-10p">Color</th>
                            <th class="wd-10p">Size</th>
                            <th class="wd-10p">Capacity</th>
                            <th class="wd-5p">QTY</th>
                            <th class="wd-5p">Price</th>
                            <th class="wd-10p">Total</th>
                            <th class="wd-10p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($product as $key => $val)
                            <tr>
                                <td>{{ $product->firstItem() + $key }}</td>
                                <td><img src="{{ asset($val->product->featured_image ? $val->product->featured_image :'uploads/no-image/no-image.png') }}"
                                         width="80px" height="50px"></td>
                                <td>{{ $val->product_name }}</td>
                                <td>{{ $val->product_code }}</td>
                                <td>{{ $val->color }}</td>
                                <td>{{ $val->size }}</td>
                                <td>{{ $val->capacity }}</td>
                                <td>{{ $val->quantity }}</td>
                                <td>${{ $val->price }}</td>
                                <td>${{ $val->total_price }}</td>
                                <td>
                                    <a href="{{ route('single.product.view', [$val->product->slug, Str::random(150)]) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye fa-lg" title="VIEW"></i>VIEW</a>
                                </td>
                            </tr>
                        @empty
                            <td colspan="20" style="padding-top: 5%; padding-bottom: 5%;">
                                <h3 class="text-dark text-center">NO PRODUCT HERE</h3>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $product->links() }}
                </div><!-- table-wrapper -->
                </div>
            </div>
            </div>
        </div><!-- sl-pagebody -->
        @include('admin.partials.copyright')
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

@endsection
