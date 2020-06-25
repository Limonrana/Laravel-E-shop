@extends('admin.layouts.app')

@section('title', 'All Brands | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Edit-Brand</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Edit Brand</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Edit a Brand</h6>
                <form action="{{ route('admin.brand.update', $brand->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="category_name">Brand Name</label>
                            <input type="text" class="form-control @error('brand_name') is-invalid @enderror" id="brand_name" name="brand_name" value="{{ $brand->brand_name }}">
                            @error('brand_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="brand_logo">Brand Logo</label>
                            <input type="file" class="form-control" id="brand_logo" name="brand_logo">
                        </div>
                        <div class="form-group">
                            <label for="brand_logo">Preview: </label>
                            <img src="{{$brand->brand_logo ? asset($brand->brand_logo) : asset('/uploads/no-image/no-image.png') }}" alt="" width="120px" height="75px">
                            <input type="hidden" class="form-control" id="old_logo" name="old_logo" value="{{ $brand->brand_logo }}">
                        </div>
                        <button type="submit" class="btn btn-info">Update</button>
                        <a href="{{ route('admin.brand') }}" class="btn btn-secondary pd-x-20" data-dismiss="modal">Cancel</a>
            </div><!-- card -->
        </div><!-- sl-pagebody -->

        @include('admin.partials.copyright')

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
