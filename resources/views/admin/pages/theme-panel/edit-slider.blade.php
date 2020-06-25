@extends('admin.layouts.app')

@section('title', 'Edit Slider | E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item">Theme-Panel</span>
            <span class="breadcrumb-item active">Edit-Slider</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Edit Slider</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Edit a Slider</h6>
                <form action="{{ route('admin.theme.slider.update', $slider->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Heading</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $slider->title }}" placeholder="Enter Heading Name">
                    </div>
                    <div class="form-group">
                        <label for="subtitle">Sub Heading</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ $slider->subtitle }}" placeholder="Enter your sub heading">
                    </div>
                    <div class="form-group">
                        <label for="subtitle">Short Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ $slider->description }}" placeholder="Enter your Short Description">
                    </div>
                    <div class="form-group">
                        <label for="button_text">Button Title</label>
                        <input type="text" class="form-control" id="button_text" name="button_text" value="{{ $slider->button_text }}" placeholder="Enter your Button Title">
                    </div>
                    <div class="form-group">
                        <label for="button_url">Button Link</label>
                        <input type="text" class="form-control" id="button_url" name="button_url" value="{{ $slider->button_url }}" placeholder="Enter your Button Link">
                    </div>
                    <div class="form-group">
                        <label for="button_bg">Button BG</label>
                        <select class="form-control select2" name="button_bg" data-placeholder="Choose one">
                            <option label="Choose one"></option>
                            <option {{ $slider->button_bg == "Theme Default" ? 'selected' : '' }}>Theme Default</option>
                            <option value="bg-success" {{ $slider->button_bg == "Success" ? 'selected' : '' }}>Success</option>
                            <option value="bg-info" {{ $slider->button_bg == "Info" ? 'selected' : '' }}>Info</option>
                            <option value="bg-primary" {{ $slider->button_bg == "Primary" ? 'selected' : '' }}>Primary</option>
                            <option value="bg-dark" {{ $slider->button_bg == "Dark" ? 'selected' : '' }}>Dark</option>
                            <option value="bg-danger" {{ $slider->button_bg == "Danger" ? 'selected' : '' }}>Danger</option>
                        </select>
                    </div>
                    <div class="form-group">
                            <label for="button_bg">Slider Image</label><br>
                            <label class="custom-file">
                                <input type="file" id="file2" name="slider_image" class="custom-file-input" onchange="document.getElementById('slider_image_show').src = window.URL.createObjectURL(this.files[0])" style="width: 2000px">
                                <span class="custom-file-control custom-file-control-primary"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="button_bg">Preview</label><br>
                            <img src="{{ asset($slider->slider_image) }}" id="slider_image_show" width="500px">
                        </div>
                        <button type="submit" class="btn btn-info">Update</button>
            </div><!-- card -->
        </div><!-- sl-pagebody -->

        @include('admin.partials.copyright')

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
