@extends('admin.layouts.app')

@section('title', 'All Sub-Categories | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Category</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>All Sub-Categories</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">Sub-Category List</h6>
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
                            <th class="wd-15p">Subcategory name</th>
                            <th class="wd-15p">Category name</th>
                            <th class="wd-20p">Created</th>
                            <th class="wd-15p">Updated</th>
                            <th class="wd-10p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($subcategory as $key => $val)
                        <tr>
                            <td>{{ $subcategory->firstItem() + $key }}</td>
                            <td>{{ $val->subcategory_name }}</td>
                            <td>{{ $val->get_category->category_name }}</td>
                            <td>{{ $val->created_at ? $val->created_at->diffForHumans() : "N/A" }}</td>
                            <td>{{ $val->updated_at ? $val->updated_at->diffForHumans() : "N/A" }}</td>
                            <td>
                                <a href="{{ route('admin.subcategory.edit', $val->id) }}" class="btn btn-sm btn-outline-info">EDIT</a>
                                <a href="{{ route('admin.subcategory.delete', $val->id) }}" class="btn btn-sm btn-outline-danger" id="delete">DELETE</a>
                            </td>
                        </tr>
                        @empty
                            <td colspan="20" style="padding-top: 15%; padding-bottom: 15%;">
                                <h3 class="text-dark text-center">NO MORE SUBCATEGORY HERE</h3>
                                <div class="text-center pt-3">
                                    <a href="#" class="btn btn-md btn-info" data-toggle="modal" data-target="#modaldemo3">Create First One</a>
                                </div>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $subcategory->links() }}
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
                    <form action="{{ route('admin.subcategory.store') }}" method="post">
                        @csrf
                        <div class="modal-body pd-20">
                            <p class="mg-b-5">
                                <div class="form-group">
                                    <label for="subcategory_name">Subcategory Name</label>
                                    <input type="text" class="form-control @error('subcategory_name') is-invalid @enderror" id="subcategory_name" name="subcategory_name" placeholder="Enter Sub-Category Name">
                                    @error('subcategory_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="subcategory_name">Category Name</label>
                                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        <option>Select Category</option>
                                        @foreach($category as $val)
                                        <option value="{{ $val->id }}">{{ $val->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
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
