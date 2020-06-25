@extends('admin.layouts.app')

@section('title', 'All Coupons | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Coupon</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>All Coupons</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">Coupons List</h6>
                        </div>
                        <div class="col-lg-2 text-right pr-0 mb-2">
                            <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modaldemo3">Add New</a>
                        </div>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-5p">SL</th>
                            <th class="wd-15p">Coupon name</th>
                            <th class="wd-15p">Coupon code</th>
                            <th class="wd-15p">Discount (%)</th>
                            <th class="wd-15p">Created</th>
                            <th class="wd-15p">Updated</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($coupon as $key => $val)
                        <tr>
                            <td>{{ $coupon->firstItem() + $key }}</td>
                            <td>{{ $val->coupon_name }}</td>
                            <td>{{ $val->coupon_code }}</td>
                            <td>{{ $val->discount }}%</td>
                            <td>{{ $val->created_at ? $val->created_at->diffForHumans() : "N/A" }}</td>
                            <td>{{ $val->updated_at ? $val->updated_at->diffForHumans() : "N/A" }}</td>
                            <td>
                                <a href="{{ route('admin.coupon.edit', $val->id) }}" class="btn btn-sm btn-outline-info">EDIT</a>
                                <a href="{{ route('admin.coupon.delete', $val->id) }}" class="btn btn-sm btn-outline-danger" id="delete">DELETE</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $coupon->links() }}
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->

        @include('admin.partials.copyright')

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <!-- ########## MODEL START ########## -->

        <!-- LARGE MODAL -->
        <div id="modaldemo3" class="modal fade">
            <div class="modal-dialog modal-lg" role="document" style="width: 35%;">
                <div class="modal-content tx-size-sm">
                    <div class="modal-header pd-x-20">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Coupon</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.coupon.store') }}" method="post">
                        @csrf
                        <div class="modal-body pd-20">
                            <p class="mg-b-5">
                                <div class="form-group">
                                    <label for="coupon_name">Coupon name</label>
                                    <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" id="coupon_name" name="coupon_name" placeholder="Enter Coupon Name">
                                    @error('coupon_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                        <label for="coupon_code">Coupon code</label>
                                        <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" id="coupon_code" name="coupon_code" placeholder="Enter Coupon Code">
                                        @error('coupon_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="discount">Discount (%)</label>
                                    <input type="text" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" placeholder="Enter Discount (%)">
                                    @error('discount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </p>
                        </div><!-- modal-body -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info pd-x-20">Publish</button>
                            <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div><!-- modal-dialog -->
        </div><!-- modal -->
@endsection
