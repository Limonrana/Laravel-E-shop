@extends('admin.layouts.app')

@section('title', 'Edit Coupons | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Coupons</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Edit Coupons</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Edit a Coupon</h6>
                <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="post">
                    @csrf
                        <div class="form-group">
                            <label for="coupon_name">Coupon name</label>
                            <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" id="coupon_name" name="coupon_name" value="{{ $coupon->coupon_name }}">
                            @error('coupon_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="coupon_code">Coupon code</label>
                            <input type="text" class="form-control @error('coupon_code') is-invalid @enderror" id="coupon_code" name="coupon_code"  value="{{ $coupon->coupon_code }}">
                            @error('coupon_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="discount">Discount (%)</label>
                            <input type="text" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount"  value="{{ $coupon->discount }}">
                            @error('discount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-info">Update</button>
                        <a href="{{ route('admin.coupon') }}" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</a>
                </form>
            </div><!-- card -->
        </div><!-- sl-pagebody -->

        @include('admin.partials.copyright')

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
