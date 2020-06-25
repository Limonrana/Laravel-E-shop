@extends('admin.layouts.app')

@section('title', 'All Brands | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.brand') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Brands</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>All Brands</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">Brands List</h6>
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
                            <th class="wd-15p">SL</th>
                            <th class="wd-15p">Logo</th>
                            <th class="wd-15p">Brand name</th>
                            <th class="wd-20p">Created</th>
                            <th class="wd-15p">Updated</th>
                            <th class="wd-10p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brand as $key => $val)
                        <tr>

                            <td>{{ $brand->firstItem() + $key }}</td>
                            <td><img src="{{$val->brand_logo ? asset($val->brand_logo) : asset('/uploads/no-image/no-image.png') }}" alt="" width="60px" height="45px"></td>
                            <td>{{ $val->brand_name }}</td>
                            <td>{{ $val->created_at ? $val->created_at->diffForHumans() : "N/A" }}</td>
                            <td>{{ $val->updated_at ? $val->updated_at->diffForHumans() : "N/A" }}</td>
                            <td>
                                <a href="{{ route('admin.brand.edit', $val->id) }}" class="btn btn-sm btn-outline-info">EDIT</a>
                                <a href="{{ route('admin.brand.delete', $val->id) }}" class="btn btn-sm btn-outline-danger" id="delete">DELETE</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $brand->links() }}
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
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Brand</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body pd-20">
                            <p class="mg-b-5">
                                <div class="form-group">
                                    <label for="brand_name">Brand Name</label>
                                    <input type="text" class="form-control @error('brand_name') is-invalid @enderror" id="brand_name" name="brand_name" placeholder="Enter Brand Name">
                                    @error('brand_name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="brand_logo">Brand Logo</label>
                                    <input type="file" class="form-control" id="brand_logo" name="brand_logo" placeholder="Enter Brand Logo">
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
