@extends('admin.layouts.app')

@section('title', 'Low Stock Products | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Low Stock</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Low Stock</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">Product List</h6>
                        </div>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-10p">SL</th>
                            <th class="wd-10p">Image</th>
                            <th class="wd-10p">Product ID</th>
                            <th class="wd-15p">Product name</th>
                            <th class="wd-10p">Category</th>
                            <th class="wd-10p">Brand</th>
                            <th class="wd-10p">Quantity</th>
                            <th class="wd-10p">Status</th>
                            <th class="wd-15">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($product as $key => $val)
                        <tr>
                            <td>{{ $product->firstItem() + $key }}</td>
                            <td><img src="{{ asset($val->featured_image ? $val->featured_image : 'uploads/no-image/no-image.png') }}"
                            width="80px" height="50px"></td>
                            <td>{{ $val->product_code }}</td>
                            <td>{{ $val->product_name }}</td>
                            <td>{{ $val->get_category->category_name }}</td>
                            <td>{{ $val->get_brand->brand_name }}</td>
                            <td>{{ $val->product_quantity }}</td>
                            <td>
                                @if ($val->product_quantity >= 100)
                                    <span class="badge badge-success">HIGH STOCK</span>
                                @elseif($val->product_quantity >= 6)
                                    <span class="badge badge-info">MEDIUM STOCK</span>
                                @elseif($val->product_quantity <= 5)
                                    <span class="badge badge-warning">LOW STOCK</span>
                                @elseif ($val->product_quantity == 0)
                                    <span class="badge badge-danger">OUT OF STOCK</span>
                                @else
                                @endif
                            </td>
                            <td>
                                @if ($val->status == 1)
                                    <a href="{{ route('admin.product.inactive', $val->id) }}" class="btn btn-sm btn-warning">Disable</a>
                                    <a href="{{ route('single.product.view', [$val->slug, Str::random(150)]) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-eye fa-lg" title="VIEW"></i></a>
                                    <a href="{{ route('admin.product.edit', $val->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil fa-lg" title="EDIT"></i></a>
                                @else
                                    <a href="{{ route('admin.product.active', $val->id) }}" class="btn btn-sm btn-success">Enable</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <td colspan="20" style="padding-top: 15%; padding-bottom: 15%;">
                                <h3 class="text-dark text-center">NO MORE LOW STOCK PRODUCT HERE</h3>
                                <div class="text-center pt-3">
                                    <a href="{{ route('admin.stock') }}" class="btn btn-md btn-info" >See All</a>
                                </div>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $product->links() }}
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
