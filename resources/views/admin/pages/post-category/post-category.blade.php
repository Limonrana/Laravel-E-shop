@extends('admin.layouts.app')

@section('title', 'All Post Categories | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Category</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>All Post Categories</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">Post Category List</h6>
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
                            <th class="wd-15p">Category name (EN)</th>
                            <th class="wd-15p">Category name (BN)</th>
                            <th class="wd-15p">Created</th>
                            <th class="wd-15p">Updated</th>
                            <th class="wd-10p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($category as $key => $val)
                        <tr>
                            <td>{{ $category->firstItem() + $key }}</td>
                            <td>{{ $val->category_name_en }}</td>
                            <td>{{ $val->category_name_bn ? $val->category_name_bn : "N/A" }}</td>
                            <td>{{ $val->created_at ? $val->created_at->diffForHumans() : "N/A" }}</td>
                            <td>{{ $val->updated_at ? $val->updated_at->diffForHumans() : "N/A" }}</td>
                            <td>
                                <a href="{{ route('admin.post.category.edit', $val->id) }}" class="btn btn-sm btn-outline-info">EDIT</a>
                                <a href="{{ route('admin.post.category.delete', $val->id) }}" class="btn btn-sm btn-outline-danger" id="delete">DELETE</a>
                            </td>
                        </tr>
                        @empty
                            <td colspan="20" style="padding-top: 15%; padding-bottom: 15%;">
                                <h3 class="text-dark text-center">NO MORE CATEGORY HERE</h3>
                                <div class="text-center pt-3">
                                    <a href="#" class="btn btn-md btn-info" data-toggle="modal" data-target="#modaldemo3">Create First Product</a>
                                </div>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $category->links() }}
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
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Post Category</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.post.category.store') }}" method="post">
                        @csrf
                        <div class="modal-body pd-20">
                            <p class="mg-b-5">
                                <div class="form-group">
                                    <label for="category_name_en">Category Name (EN)</label>
                                    <input type="text" class="form-control @error('category_name_en') is-invalid @enderror" id="category_name_en" name="category_name_en" placeholder="Enter Category Name (English)">
                                    @error('category_name_en')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_name_bn">Category Name (BN)</label>
                                    <input type="text" class="form-control @error('category_name_bn') is-invalid @enderror" id="category_name_bn" name="category_name_bn" placeholder="Category Name (Bengali) - Optional">
                                    @error('category_name_bn')
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
