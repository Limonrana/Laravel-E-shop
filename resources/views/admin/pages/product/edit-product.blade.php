@extends('admin.layouts.app')
@section('title', 'Edit Product | E-SHOP')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">E-SHOP</a>
            <span class="breadcrumb-item active">Edit Product</span>
        </nav>
        <div class="sl-pagebody">
            <div class="row row-sm mg-t-20">
                <div class="col-xl-9">
                    <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                        <h6 class="card-body-title">Edit a Product</h6>
                        <form class="mt-4" action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" type="text" value="{{ $product->product_name }}">
                                @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Product Code</label>
                                    <input class="form-control @error('product_code') is-invalid @enderror" id="product_code" name="product_code" type="text" value="{{ $product->product_code }}">
                                    @error('product_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="product_name @error('product_quantity') is-invalid @enderror">Product Quantity</label>
                                    <input class="form-control" id="product_quantity" name="product_quantity" type="text" value="{{ $product->product_quantity }}">
                                    @error('product_quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="category_id">Category</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                        <option>Choose...</option>
                                        @foreach($category as $val)
                                            <option value="{{ $val->id }}" {{ $val->id == $product->category_id  ? 'selected' : '' }}>{{ $val->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="subcategory_id">Subcategory</label>
                                    <select class="form-control" id="subcategory_id" name="subcategory_id">
                                        @foreach($subcategory as $val)
                                            <option value="{{ $val->id }}" {{ $val->id == $product->subcategory_id ? 'selected' : '' }}>{{ $val->subcategory_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="brand_id">Brand</label>
                                    <select class="form-control" id="brand_id" name="brand_id">
                                        <option>Choose...</option>
                                        @foreach($brand as $val)
                                            <option value="{{ $val->id }}" {{ $val->id == $product->brand_id ? 'selected' : '' }}>{{ $val->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="product_size">Product Size</label>
                                    <input class="form-control" data-role="tagsinput" id="product_size" name="product_size" type="text" value="{{ $product->product_size }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="product_name">Product Color</label>
                                    <input class="form-control" data-role="tagsinput" id="product_color" name="product_color" type="text" value="{{ $product->product_color }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="product_name">Product Capacity</label>
                                    <input class="form-control" data-role="tagsinput" id="product_capacity" name="product_capacity" type="text" value="{{ $product->product_capacity }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="selling_price">Selling Price</label>
                                    <div class="input-group">
                                        <span class="input-group-addon tx-size-sm lh-2">$</span>
                                        <input class="form-control @error('selling_price') is-invalid @enderror" id="selling_price" name="selling_price" value="{{ $product->selling_price }}" type="number">
                                        @error('selling_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="discount_price">Discount Price</label>
                                    <div class="input-group">
                                        <span class="input-group-addon tx-size-sm lh-2">$</span>
                                        <input class="form-control" id="discount_price" name="discount_price" placeholder="99.20 (Optional)" type="number" value="{{ $product->discount_price ?? $product->discount_price }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_description">Description</label>
                                <textarea name="product_description" class="form-control my-editor">{!! $product->product_description !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="video_link">Video Link</label>
                                <input class="form-control" id="video_link" name="video_link" type="text" value="{{ $product->video_link }}">
                            </div><br>
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label class="ckbox">
                                            <input type="checkbox" name="header_slider" value="1" {{ $product->header_slider == 1 ? "checked" : '' }} ><span>Header Slider</span>
                                        </label>
                                    </div><!-- col-3 -->
                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <label class="ckbox">
                                            <input type="checkbox" name="hot_deal" value="1" {{ $product->hot_deal == 1 ? "checked" : '' }} ><span>Hot Deal</span>
                                        </label>
                                    </div><!-- col-3 -->
                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <label class="ckbox">
                                            <input type="checkbox" name="best_rated" value="1" {{ $product->best_rated == 1 ? "checked" : '' }} ><span>Best Rated</span>
                                        </label>
                                    </div><!-- col-3 -->
                                </div><!-- row -->
                                <div class="row mg-t-10">
                                    <div class="col-lg-4">
                                        <label class="ckbox">
                                            <input type="checkbox" name="mid_slider" value="1" {{ $product->mid_slider == 1 ? "checked" : '' }} ><span>Mid Slider</span>
                                        </label>
                                    </div><!-- col-3 -->
                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <label class="ckbox">
                                            <input type="checkbox" name="hot_new" value="1" {{ $product->hot_new == 1 ? "checked" : '' }} ><span>Hot New</span>
                                        </label>
                                    </div><!-- col-3 -->
                                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                        <label class="ckbox">
                                            <input type="checkbox" name="trend" value="1" {{ $product->trend == 1 ? "checked" : ''}} ><span>Trendy Product</span>
                                        </label>
                                    </div><!-- col-3 -->
                                </div><!-- row -->
                            </div>

                            <div class="form-group">
                                <label for="short_description">Short Description</label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="4">{{ $product->short_description }}</textarea>
                                @error('short_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                    </div><!-- card -->
                </div><!-- col-6 -->
                <div class="col-xl-3 mg-t-25 mg-xl-t-0">
                    <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
                        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Featured Image</h6>
                        <div class="custom-file">
                            <input class="custom-file-input form-control @error('featured_image') is-invalid @enderror" id="featured_image" onchange="document.getElementById('featured_image_show').src = window.URL.createObjectURL(this.files[0])" name="featured_image" type="file">
                            <input type="hidden" name="old_featured_image" value="{{ $product->featured_image }}">
                            <span class="custom-file-control custom-file-control-inverse"></span>
                            @error('featured_image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="preview_image mt-3">
                            <img src="{{ asset($product->featured_image) }}" id="featured_image_show" width="300px" style="border: 1px solid black">
                        </div>
                        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 mt-3">Gallery Image</h6>
                        <div class="custom-file">
                            <input class="custom-file-input form-control" id="gallery_image_1" onchange="document.getElementById('gallery_image_1_show').src = window.URL.createObjectURL(this.files[0])" name="gallery_image_1" type="file">
                            <input type="hidden" name="old_gallery_image_1" value="{{ $product->gallery_image_1 }}">
                            <span class="custom-file-control custom-file-control-inverse"></span>
                        </div>
                        <div class="custom-file mt-4">
                            <input class="custom-file-input form-control" id="gallery_image_2" onchange="document.getElementById('gallery_image_2_show').src = window.URL.createObjectURL(this.files[0])" name="gallery_image_2" type="file">
                            <input type="hidden" name="old_gallery_image_2" value="{{ $product->gallery_image_2 }}">
                            <span class="custom-file-control custom-file-control-inverse"></span>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-6">
                                <img <?php if ($product->gallery_image_1){ ?> src="{{ asset($product->gallery_image_1) }}" <?php } ?> id="gallery_image_1_show" width="150px" style="border: 1px solid black">
                            </div>
                            <div class="col-md-6">
                                <img <?php if ($product->gallery_image_2){ ?> src="{{ asset($product->gallery_image_2) }}" <?php } ?> id="gallery_image_2_show" width="150px" style="border: 1px solid black">
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <label for="slug">Slug</label>
                            <input class="form-control" id="slug" name="slug" type="text" value="{{ $product->slug }}">
                        </div>
                        <div class="row mg-t-30 text-right">
                            <div class="col-sm-12">
                                <div class="form-layout-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div><!-- form-layout-footer -->
                            </div><!-- col-8 -->
                        </div>
                        </form>
                    </div><!-- card -->
                </div><!-- col-6 -->
            </div><!-- row -->
        </div><!-- sl-pagebody -->
        @include('admin.partials.copyright')
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

@endsection

@section('admin-css')
    <link href="{{ asset('backend/lib/tagsinput/tagsinput.css') }}" rel="stylesheet">
@endsection

@section('admin-js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>



    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name= "category_id"]').on('change', function () {
                var cat_id = $(this).val();
                if (cat_id) {
                    $.ajax({
                        url         : '/admin/get/subcategory/' + cat_id,
                        type        : "GET",
                        data_type   : "json",
                        success     : function (data) {
                            console.log(data);
                            $('select[name="subcategory_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="subcategory_id"]').append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                            })
                        }
                    })
                }
            })
        });

        $('#product_name').keyup(function () {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
        });
    </script>

    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        var editor_config = {
            path_absolute : "/",
            selector: "textarea.my-editor",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'admin/laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };
        tinymce.init(editor_config);
    </script>
@endsection
