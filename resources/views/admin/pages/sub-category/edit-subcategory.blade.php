@extends('admin.layouts.app')

@section('title', 'All Sub-Categories | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Edit-subcategory</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Edit Sub-Category</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Edit a Sub-Category</h6>
                <form action="{{ route('admin.subcategory.update', $subcategory->id) }}" method="post">
                    @csrf
                        <div class="form-group">
                            <label for="subcategory_name">Subcategory Name</label>
                            <input type="text" class="form-control @error('subcategory_name') is-invalid @enderror" id="subcategory_name" name="subcategory_name" value="{{ $subcategory->subcategory_name }}">
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
                                    <option value="{{ $val->id }}" {{ $val->id == $subcategory->category_id ? 'selected' : '' }}>{{ $val->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-info">Update</button>
                        <a href="{{ route('admin.subcategory') }}" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</a>
            </div><!-- card -->
        </div><!-- sl-pagebody -->

        @include('admin.partials.copyright')

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
