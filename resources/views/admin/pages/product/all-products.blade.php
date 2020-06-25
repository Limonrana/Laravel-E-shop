@extends('admin.layouts.app')

@section('title', 'All Products | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Products</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>All Products</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">Product List</h6>
                        </div>
                        <div class="col-lg-2 text-right pr-0 mb-2">
                            <a href="{{ route('admin.product.add.new') }}" class="btn btn-sm btn-info" >Add New</a>
                        </div>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-10p">SL</th>
                            <th class="wd-10p">Image</th>
                            <th class="wd-15p">Product name</th>
                            <th class="wd-10p">Category</th>
                            <th class="wd-10p">Brand</th>
                            <th class="wd-10p">Price</th>
                            <th class="wd-10p">Discount Price</th>
                            <th class="wd-10p">Created</th>
                            <th class="wd-15">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($product as $key => $val)
                        <tr>
                            <td>{{ $product->firstItem() + $key }}</td>
                            <td><img src="{{ asset($val->featured_image ? $val->featured_image : 'uploads/no-image/no-image.png') }}"
                                     width="80px" height="50px"></td>
                            <td>{{ $val->product_name }}</td>
                            <td>{{ $val->get_category->category_name }}</td>
                            <td>{{ $val->get_brand->brand_name }}</td>
                            <td>{{ $val->selling_price }}</td>
                            <td>{{ $val->discount_price ? $val->discount_price : 'N/A' }}</td>
                            <td>{{ $val->created_at ? $val->created_at->diffForHumans() : "N/A" }}</td>
                            <td>
                                @if ($val->status == 1)
                                    <a href="{{ route('admin.product.inactive', $val->id) }}" class="btn btn-sm btn-warning">Disable</a>
                                    <a href="{{ route('single.product.view', [$val->slug, Str::random(150)]) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye fa-lg" title="VIEW"></i></a>
                                    <a href="{{ route('admin.product.edit', $val->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil fa-lg" title="EDIT"></i></a>
                                    <a href="{{ route('admin.product.delete', $val->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-close fa-lg" title="DELETE"></i></a>
                                @else
                                    <a href="{{ route('admin.product.active', $val->id) }}" class="btn btn-sm btn-success">Enable</a>
                                    <a href="{{ route('admin.product.delete', $val->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-close fa-lg" title="DELETE"></i></a>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <td colspan="20" style="padding-top: 15%; padding-bottom: 15%;">
                                <h3 class="text-dark text-center">NO MORE PRODUCT HERE</h3>
                                <div class="text-center pt-3">
                                    <a href="{{ route('admin.product.add.new') }}" class="btn btn-md btn-info" >Create First Product</a>
                                </div>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $product->links() }}
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->

        @include('admin.partials.copyright')

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
