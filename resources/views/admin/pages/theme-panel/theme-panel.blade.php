@extends('admin.layouts.app')

@section('title', 'E-SHOP - Theme Panel')

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <a class="breadcrumb-item" href="">Theme-Panel</a>
            <span class="breadcrumb-item active">Header/Footer</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Theme Panel</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Header Panel</h6>
                <p class="mg-b-20 mg-sm-b-30">Put your all data and update</p>
                <form action="{{ route('admin.theme.header.update', $get->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Topbar Message</label>
                                <input class="form-control" type="text" name="top_massage" value="{{ $get->top_massage }}" placeholder="Welcome to our Store!">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Phone Sub-Heading</label>
                                <input class="form-control" type="text" name="phone_subtitle" value="{{ $get->phone_subtitle }}" placeholder="Call Us Now">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Phone Number</label>
                                <input class="form-control" type="text" name="phone_number" value="{{ $get->phone_number }}" placeholder="+123 5678 890">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Logo</label><br>
                                    <label class="custom-file">
                                        <input type="file" id="file2" name="logo" class="custom-file-input" style="width: 570px;">
                                        <span class="custom-file-control custom-file-control-primary"></span>
                                        <input type="hidden" name="old_logo" value="{{ $get->logo }}">
                                    </label>
                            </div>
                        </div><!-- col-3 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <div class="form-group">
                                    <label class="form-control-label">Logo Width</label>
                                    <input class="form-control" type="text" name="logo_width" value="{{ $get->logo_width }}" placeholder="30px">
                                </div>
                            </div>
                        </div><!-- col-3 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Menu Banner</label><br>
                                <label class="custom-file">
                                    <input type="file" id="file2" name="menu_image" class="custom-file-input" style="width: 570px;">
                                    <span class="custom-file-control custom-file-control-primary"></span>
                                    <input type="hidden" name="old_menu_image" value="{{ $get->menu_image }}">
                                </label>
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
                <h6 class="card-body-title">Footer Panel</h6>
                <p class="mg-b-20 mg-sm-b-30">Put your all data and update</p>

                <form action="{{ route('admin.theme.footer.update', $get->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Footer Heading</label>
                                    <input class="form-control" type="text" name="footer_title" value="{{ $get->footer_title }}" placeholder="CONTACT US">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Address</label>
                                    <input class="form-control" type="text" name="address" value="{{ $get->address }}" placeholder="NY, USA 20388">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Phone Number</label>
                                    <input class="form-control" type="text" name="phone_footer" value="{{ $get->phone_footer }}" placeholder="+123 5678 890">
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <div class="form-group">
                                        <label class="form-control-label">Email</label>
                                        <input class="form-control" type="email" name="email_footer" value="{{ $get->email_footer }}" placeholder="example@gmail.com">
                                    </div>
                                </div>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <div class="form-group">
                                        <label class="form-control-label">Working Day</label>
                                        <input class="form-control" type="text" name="working_day" value="{{ $get->working_day }}" placeholder="Mon - Sun / 9:00AM - 8:00PM">
                                    </div>
                                </div>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <div class="form-group">
                                        <label class="form-control-label">Newsletter Title</label>
                                        <input class="form-control" type="text" name="newsletter_title" value="{{ $get->newsletter_title }}" placeholder="SUBSCRIBE NEWSLETTER">
                                    </div>
                                </div>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <div class="form-group">
                                        <label class="form-control-label">Newsletter Sub-Title</label>
                                        <input class="form-control" type="text" name="newsletter_subtitle" value="{{ $get->newsletter_subtitle }}" placeholder="Get all the latest informati...">
                                    </div>
                                </div>
                            </div><!-- col-3 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <div class="form-group">
                                        <label class="form-control-label">Copyright Text</label>
                                        <input class="form-control" type="text" name="copyright_text" value="{{ $get->copyright_text }}" placeholder="example. © 2020. All Rights Reserved">
                                    </div>
                                </div>
                            </div><!-- col-3 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Payment Logo</label><br>
                                    <label class="custom-file">
                                        <input type="file" id="file2" name="payment_logo" class="custom-file-input" style="width: 570px;">
                                        <span class="custom-file-control custom-file-control-primary"></span>
                                        <input type="hidden" name="old_payment_logo" value="{{ $get->payment_logo }}">
                                    </label>
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

@section('admin-css')
    <link href="{{ asset('backend/lib/highlightjs/github.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('admin-js')
    <script src="{{ asset('backend/lib/highlightjs/highlight.pack.js') }}"></script>
    <script src="{{ asset('backend/lib/select2/js/select2.min.js') }}"></script>
    <script>
        $(function(){
            'use strict';

            $('.select2').select2({
                minimumResultsForSearch: Infinity
            });
        })
    </script>
@endsection
