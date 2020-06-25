@extends('admin.layouts.app')

@section('title', 'All Categories | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item">Theme-Panel</span>
            <span class="breadcrumb-item active">Slider</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>All Slider</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 pl-0">
                            <h6 class="card-body-title">Slider List</h6>
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
                            <th class="wd-5p">SL</th>
                            <th class="wd-20p">Image</th>
                            <th class="wd-20p">Title</th>
                            <th class="wd-20p">Sub-Title</th>
                            <th class="wd-10p">Created</th>
                            <th class="wd-10p">Updated</th>
                            <th class="wd-15p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($slider as $key => $val)
                            <tr>
                                <td>{{ $slider->firstItem() + $key }}</td>
                                <td><img src="{{ asset($val->slider_image) }}" width="220px" height="60px" alt=""></td>
                                <td>{{ $val->title }}</td>
                                <td>{{ $val->subtitle }}</td>
                                <td>{{ $val->created_at ? $val->created_at->diffForHumans() : "N/A" }}</td>
                                <td>{{ $val->updated_at ? $val->updated_at->diffForHumans() : "N/A" }}</td>
                                <td>
                                    <a href="{{ route('admin.theme.slider.edit', $val->id) }}" class="btn btn-sm btn-outline-info">EDIT</a>
                                    <a href="{{ route('admin.theme.slider.delete', $val->id) }}" class="btn btn-sm btn-outline-danger" id="delete">DELETE</a>
                                </td>
                            </tr>
                        @empty
                            <td colspan="20" style="padding-top: 15%; padding-bottom: 15%;">
                                <h3 class="text-dark text-center">NO MORE SLIDER HERE</h3>
                                <div class="text-center pt-3">
                                    <a href="#" class="btn btn-md btn-info" data-toggle="modal" data-target="#modaldemo3">Create First Slider</a>
                                </div>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $slider->links() }}
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <!-- ########## MODEL START ########## -->

    <!-- LARGE MODAL -->
    <div id="modaldemo3" class="modal fade">
        <div class="modal-dialog modal-lg" role="document" style="width: 35%;">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Slider</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.theme.slider.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pd-20">
                        <p class="mg-b-5">
                        <div class="form-group">
                            <label for="title">Heading</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Heading Name">
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Sub Heading</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Enter your sub heading">
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Short Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter your Short Description">
                        </div>
                        <div class="form-group">
                            <label for="button_text">Button Title</label>
                            <input type="text" class="form-control" id="button_text" name="button_text" placeholder="Enter your Button Title">
                        </div>
                        <div class="form-group">
                            <label for="button_url">Button Link</label>
                            <input type="text" class="form-control" id="button_url" name="button_url" placeholder="Enter your Button Link">
                        </div>
                        <div class="form-group">
                            <label for="button_bg">Button BG</label>
                            <select class="form-control select2" name="button_bg" data-placeholder="Choose one">
                                <option label="Choose one"></option>
                                <option>Theme Default</option>
                                <option value="bg-success">Success</option>
                                <option value="bg-info">Info</option>
                                <option value="bg-primary">Primary</option>
                                <option value="bg-dark">Dark</option>
                                <option value="bg-danger">Danger</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="button_bg">Slider Image</label><br>
                            <label class="custom-file">
                                <input type="file" id="file2" name="slider_image" class="custom-file-input" style="width: 640px">
                                <span class="custom-file-control custom-file-control-primary"></span>
                            </label>
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
