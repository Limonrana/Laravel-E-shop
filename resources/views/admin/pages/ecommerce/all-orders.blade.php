@extends('admin.layouts.app')

@section('title', 'All Orders | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">All-Orders</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>All Orders</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">Order Lists</h6>
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
                                @if ($val->refund == 0)
                                    @if ($val->status == 0)
                                        <span class="badge badge-warning text-white p-1">Pending/New</span>
                                    @elseif ($val->status == 1)
                                        <span class="badge badge-info">Payment Confirm</span>
                                    @elseif ($val->status == 2)
                                        <span class="badge badge-primary">Processing</span>
                                    @elseif ($val->status == 3)
                                        <span class="badge badge-danger">Complete</span>
                                    @else
                                        <span class="badge badge-warning text-white p-1">On-Hold</span>
                                    @endif
                                @else
                                    <span class="badge badge-danger p-1"><i class="fa fa-exchange"></i> Refunded</span>
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
                                    <a href="{{ route('admin.all.orders') }}" class="btn btn-md btn-info" >Total Orders</a>
                                </div>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $order->links() }}
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
