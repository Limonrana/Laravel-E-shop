@extends('admin.layouts.app')

@section('title', 'Home Options - E-SHOP')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <a class="breadcrumb-item" href="">Homepage</a>
            <span class="breadcrumb-item active">Panel</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Homepage Panel</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title pb-2">Banner Panel</h6>
                <form action="{{ route('admin.page.banner.update', $get->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Left Banner 1</label><br>
                                    <label class="custom-file">
                                        <input type="file" id="file2" name="left_banner_1" class="custom-file-input" onchange="document.getElementById('left_banner_1').src = window.URL.createObjectURL(this.files[0])" style="width: 570px;">
                                        <span class="custom-file-control custom-file-control-primary"></span>
                                    </label>
                                    <div class="show-banner mt-2 mb-2">
                                        <img src="{{ asset( $get->left_banner_1 ? $get->left_banner_1 : ' ' ) }}" id="left_banner_1" height="200px">
                                    </div>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Mid Banner 1</label><br>
                                    <label class="custom-file">
                                        <input type="file" id="file2" name="mid_banner_1" class="custom-file-input" onchange="document.getElementById('mid_banner_1').src = window.URL.createObjectURL(this.files[0])" style="width: 570px;">
                                        <span class="custom-file-control custom-file-control-primary"></span>
                                    </label>
                                    <div class="show-banner mt-2 mb-2">
                                        <img src="{{ asset( $get->mid_banner_1 ? $get->mid_banner_1 : ' ' ) }}" id="mid_banner_1" height="200px">
                                    </div>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Right Banner 1</label><br>
                                    <label class="custom-file">
                                        <input type="file" id="file2" name="right_banner_1" class="custom-file-input" onchange="document.getElementById('right_banner_1').src = window.URL.createObjectURL(this.files[0])" style="width: 570px;">
                                        <span class="custom-file-control custom-file-control-primary"></span>
                                    </label>
                                    <div class="show-banner mt-2 mb-2">
                                        <img src="{{ asset( $get->right_banner_1 ? $get->right_banner_1 : ' ' ) }}" id="right_banner_1" height="200px">
                                    </div>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Left Banner 2</label><br>
                                    <label class="custom-file">
                                        <input type="file" id="file2" name="left_banner_2" class="custom-file-input" onchange="document.getElementById('left_banner_2').src = window.URL.createObjectURL(this.files[0])" style="width: 570px;">
                                        <span class="custom-file-control custom-file-control-primary"></span>
                                    </label>
                                    <div class="show-banner mt-2 mb-2">
                                        <img src="{{ asset( $get->left_banner_2 ? $get->left_banner_2 : ' ' ) }}" id="left_banner_2" height="200px">
                                    </div>
                                </div>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Mid Banner 2</label><br>
                                    <label class="custom-file">
                                        <input type="file" id="file2" name="mid_banner_2" class="custom-file-input" onchange="document.getElementById('mid_banner_2').src = window.URL.createObjectURL(this.files[0])" style="width: 570px;">
                                        <span class="custom-file-control custom-file-control-primary"></span>
                                    </label>
                                    <div class="show-banner mt-2 mb-2">
                                        <img src="{{ asset( $get->mid_banner_2 ? $get->mid_banner_2 : ' ' ) }}" id="mid_banner_2" height="200px">
                                    </div>
                                </div>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Right Banner 2</label><br>
                                    <label class="custom-file">
                                        <input type="file" id="file2" name="right_banner_2" class="custom-file-input" onchange="document.getElementById('right_banner_2').src = window.URL.createObjectURL(this.files[0])" style="width: 570px;">
                                        <span class="custom-file-control custom-file-control-primary"></span>
                                    </label>
                                    <div class="show-banner mt-2 mb-2">
                                        <img src="{{ asset( $get->right_banner_2 ? $get->right_banner_2 : ' ' ) }}" id="right_banner_2" height="200px">
                                    </div>
                                </div>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Left Banner 3</label><br>
                                    <label class="custom-file">
                                        <input type="file" id="file2" name="left_banner_3" class="custom-file-input" onchange="document.getElementById('left_banner_3').src = window.URL.createObjectURL(this.files[0])" style="width: 570px;">
                                        <span class="custom-file-control custom-file-control-primary"></span>
                                    </label>
                                    <div class="show-banner mt-2 mb-2">
                                        <img src="{{ asset( $get->left_banner_3 ? $get->left_banner_3 : ' ' ) }}" id="left_banner_3" height="200px">
                                    </div>
                                </div>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Mid Banner 3</label><br>
                                    <label class="custom-file">
                                        <input type="file" id="file2" name="mid_banner_3" class="custom-file-input" onchange="document.getElementById('mid_banner_3').src = window.URL.createObjectURL(this.files[0])" style="width: 570px;">
                                        <span class="custom-file-control custom-file-control-primary"></span>
                                    </label>
                                    <div class="show-banner mt-2 mb-2">
                                        <img src="{{ asset( $get->mid_banner_3 ? $get->mid_banner_3 : ' ' ) }}" id="mid_banner_3" height="200px">
                                    </div>
                                </div>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Right Banner 3</label><br>
                                    <label class="custom-file">
                                        <input type="file" id="file2" name="right_banner_3" class="custom-file-input" onchange="document.getElementById('right_banner_3').src = window.URL.createObjectURL(this.files[0])" style="width: 570px;">
                                        <span class="custom-file-control custom-file-control-primary"></span>
                                    </label>
                                    <div class="show-banner mt-2 mb-2">
                                        <img src="{{ asset( $get->right_banner_3 ? $get->right_banner_3 : ' ' ) }}" id="right_banner_3" height="200px">
                                    </div>
                                </div>
                            </div><!-- col-3 -->
                        </div><!-- row -->

                        <div class="form-layout-footer text-right">
                            <button class="btn btn-info mg-r-5" type="submit">Update</button>
                            <a href="#" class="btn btn-secondary">Cancel</a>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- card -->

            <div class="card pd-20 pd-sm-40 mg-t-20">
                <h6 class="card-body-title pb-2">Info Panel</h6>

                <form action="{{ route('admin.page.info.update', $get->id) }}" method="post">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <div class="form-group">
                                        <label class="form-control-label">Info Title 1</label>
                                        <input class="form-control" type="text" name="info_title_1" value="{{ $get->info_title_1 }}" placeholder="FREE SHIPPING & RETURN">
                                    </div>
                                </div>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <div class="form-group">
                                        <label class="form-control-label">Info Subtitle 1</label>
                                        <input class="form-control" type="text" name="info_subtitle_1" value="{{ $get->info_subtitle_1 }}" placeholder="Free shipping on all orders over $99.">
                                    </div>
                                </div>
                            </div><!-- col-3 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Info Icon 1</label><br>
                                    <select name="info_icon_1" id="info_icon_1" class="form-control">
                                        <option>Choose One</option>
                                        <option value="icon-shipping" {{ $get->info_icon_1 == 'icon-shipping' ? 'selected' : '' }}>{{ Str::upper("Icon-Shipping (Theme)") }}</option>
                                        <option value="icon-us-dollar" {{ $get->info_icon_1 == 'icon-us-dollar' ? 'selected' : '' }}>{{ Str::upper("Icon-Us-Dollar (Theme)") }}</option>
                                        <option value="icon-support" {{ $get->info_icon_1 == 'icon-support' ? 'selected' : '' }}>{{ Str::upper("Icon-Support (Theme)") }}</option>
                                        @foreach(json_decode($icon->icon_class) as $val)
                                            <option value="{{ $val }}" {{ $get->info_icon_1 == $val ? 'selected' : '' }}>{{ Str::upper($val) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-3 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <div class="form-group">
                                        <label class="form-control-label">Info Title 2</label>
                                        <input class="form-control" type="text" name="info_title_2" value="{{ $get->info_title_2 }}" placeholder="MONEY BACK GUARANTEE">
                                    </div>
                                </div>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <div class="form-group">
                                        <label class="form-control-label">Info Subtitle 2</label>
                                        <input class="form-control" type="text" name="info_subtitle_2" value="{{ $get->info_subtitle_2 }}" placeholder="100% money back guarantee">
                                    </div>
                                </div>
                            </div><!-- col-3 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Info Icon 2</label><br>
                                    <select name="info_icon_2" id="info_icon_2" class="form-control">
                                        <option>Choose One</option>
                                        <option value="icon-shipping" {{ $get->info_icon_2 == 'icon-shipping' ? 'selected' : '' }}>{{ Str::upper("Icon-Shipping (Theme)") }}</option>
                                        <option value="icon-us-dollar" {{ $get->info_icon_2 == 'icon-us-dollar' ? 'selected' : '' }}>{{ Str::upper("Icon-Us-Dollar (Theme)") }}</option>
                                        <option value="icon-support" {{ $get->info_icon_2 == 'icon-support' ? 'selected' : '' }}>{{ Str::upper("Icon-Support (Theme)") }}</option>
                                        @foreach(json_decode($icon->icon_class) as $val)
                                            <option value="{{ $val }}" {{ $get->info_icon_2 == $val ? 'selected' : '' }}>{{ Str::upper($val) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-3 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <div class="form-group">
                                        <label class="form-control-label">Info Title 3</label>
                                        <input class="form-control" type="text" name="info_title_3" value="{{ $get->info_title_3 }}" placeholder="ONLINE SUPPORT 24/7">
                                    </div>
                                </div>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <div class="form-group">
                                        <label class="form-control-label">Info Subtitle 3</label>
                                        <input class="form-control" type="text" name="info_subtitle_3" value="{{ $get->info_subtitle_3 }}" placeholder="24/7 hours unlimited support">
                                    </div>
                                </div>
                            </div><!-- col-3 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Info Icon 3</label><br>
                                    <select name="info_icon_3" id="info_icon_3" class="form-control">
                                        <option>Choose One</option>
                                        <option value="icon-shipping" {{ $get->info_icon_3 == 'icon-shipping' ? 'selected' : '' }}>{{ Str::upper("Icon-Shipping (Theme)") }}</option>
                                        <option value="icon-us-dollar" {{ $get->info_icon_3 == 'icon-us-dollar' ? 'selected' : '' }}>{{ Str::upper("Icon-Us-Dollar (Theme)") }}</option>
                                        <option value="icon-support" {{ $get->info_icon_3 == 'icon-support' ? 'selected' : '' }}>{{ Str::upper("Icon-Support (Theme)") }}</option>
                                        @foreach(json_decode($icon->icon_class) as $val)
                                        <option value="{{ $val }}" {{ $get->info_icon_3 == $val ? 'selected' : '' }}>{{ Str::upper($val) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-3 -->
                        </div><!-- row -->

                        <div class="form-layout-footer text-right">
                            <button class="btn btn-info mg-r-5" type="submit">Update</button>
                            <a href="#" class="btn btn-secondary">Cancel</a>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- card -->
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
