@extends('admin.layouts.app')

@section('title', 'Edit Shipping | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Edit-Shipping</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Edit Shipping Method</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Edit a Method</h6>
                <form action="{{ route('admin.shipping.update', $ship_method->id) }}" method="post">
                    @csrf
                            <div class="form-group">
                                <label for="shipping_title">Shipping Title</label>
                                <input type="text" class="form-control @error('shipping_title') is-invalid @enderror" id="shipping_title" value="{{ $ship_method->shipping_title }}" name="shipping_title" placeholder="Example: UPS First Class / DHL">
                                @error('shipping_title')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="shipping_type">Shipping Type</label>
                                <input type="text" class="form-control @error('shipping_type') is-invalid @enderror" id="shipping_type" value="{{ $ship_method->shipping_type }}" name="shipping_type" placeholder="Example: Flat Rate/Free Shipping">
                                @error('shipping_type')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="shipping_charge">Shipping Charge</label>
                                <input type="text" class="form-control @error('shipping_charge') is-invalid @enderror" id="shipping_charge" value="{{ $ship_method->shipping_charge }}" name="shipping_charge" placeholder="Example: 39.95">
                                @error('shipping_type')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="shipping_time">Shipping Time</label>
                                <input type="text" class="form-control @error('shipping_time') is-invalid @enderror" id="shipping_time" value="{{ $ship_method->shipping_time }}" name="shipping_time" placeholder="Example: 2-5 days Maximum/Minimum">
                                @error('shipping_time')
                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                @enderror
                            </div>
                        <button type="submit" class="btn btn-info">Update</button>
            </div><!-- card -->
        </div><!-- sl-pagebody -->

        @include('admin.partials.copyright')

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
