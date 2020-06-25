@extends('admin.layouts.app')

@section('title', 'All Shipping Methods | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Shipping</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>All Shipping Methods</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">Method Lists</h6>
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
                            <th class="wd-10p">SL</th>
                            <th class="wd-15p">Shipping Title</th>
                            <th class="wd-10p">Type</th>
                            <th class="wd-15p">Charge</th>
                            <th class="wd-15p">Shipping Time</th>
                            <th class="wd-10p">Created</th>
                            <th class="wd-10p">Status</th>
                            <th class="wd-15p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($ship_class as $key => $val)
                        <tr>
                            <td>{{ $ship_class->firstItem() + $key }}</td>
                            <td>{{ $val->shipping_title }}</td>
                            <td>{{ $val->shipping_type }}</td>
                            @if ($val->shipping_charge)
                                <td>${{ $val->shipping_charge }}</td>
                            @else
                                <td>Free</td>
                            @endif
                            <td>{{ $val->shipping_time }}</td>
                            <td>{{ $val->created_at ? $val->created_at->diffForHumans() : "N/A" }}</td>
                            @if ($val->status == 1)
                                <td><span class="badge badge-success">Active</span></td>
                            @else
                                <td><span class="badge badge-danger">Deactivate</span></td>
                            @endif
                            <td>
                                @if ($val->status == 1)
                                    <a href="{{ route('admin.shipping.inactive', $val->id) }}" class="btn btn-sm btn-warning">Disable</a>
                                    <a href="{{ route('admin.shipping.edit', $val->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil fa-lg" title="EDIT"></i></a>
                                    <a href="{{ route('admin.shipping.delete', $val->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-close fa-lg" title="DELETE"></i></a>
                                @else
                                    <a href="{{ route('admin.shipping.active', $val->id) }}" class="btn btn-sm btn-success">Enable</a>
                                    <a href="{{ route('admin.shipping.delete', $val->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-close fa-lg" title="DELETE"></i></a>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <td colspan="20" style="padding-top: 15%; padding-bottom: 15%;">
                                <h3 class="text-dark text-center">NO MORE SHIPPING METHOD HERE</h3>
                                <div class="text-center pt-3">
                                    <a href="#" class="btn btn-md btn-info" data-toggle="modal" data-target="#modaldemo3">Create First Method</a>
                                </div>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $ship_class->links() }}
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
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Category</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.shipping.store') }}" method="post">
                        @csrf
                        <div class="modal-body pd-20">
                            <p class="mg-b-5">
                                <div class="form-group">
                                    <label for="shipping_title">Shipping Title</label>
                                    <input type="text" class="form-control @error('shipping_title') is-invalid @enderror" id="shipping_title" name="shipping_title" placeholder="Example: UPS First Class / DHL">
                                    @error('shipping_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="shipping_type">Shipping Type</label>
                                    <input type="text" class="form-control @error('shipping_type') is-invalid @enderror" id="shipping_type" name="shipping_type" placeholder="Example: Flat Rate/Free Shipping">
                                    @error('shipping_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="shipping_charge">Shipping Charge</label>
                                    <input type="text" class="form-control @error('shipping_charge') is-invalid @enderror" id="shipping_charge" name="shipping_charge" placeholder="Example: 39.95">
                                    @error('shipping_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="shipping_time">Shipping Time</label>
                                    <input type="text" class="form-control @error('shipping_time') is-invalid @enderror" id="shipping_time" name="shipping_time" placeholder="Example: 2-5 days Maximum/Minimum">
                                    @error('shipping_time')
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
