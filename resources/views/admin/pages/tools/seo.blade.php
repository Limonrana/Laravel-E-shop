@extends('admin.layouts.app')
@section('title', 'SEO Information | E-SHOP')
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">E-SHOP</a>
            <span class="breadcrumb-item active">SEO</span>
        </nav>
        <div class="sl-pagebody">
            <div class="row row-sm mg-t-20">
                <div class="col-xl-9 m-auto">
                    <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                        <h6 class="card-body-title">SEO Meta Data</h6>
                        <form class="mt-4" action="{{ route('admin.tools.seo.update', $seo->id) }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="meta_title">Meta Title</label>
                                    <input class="form-control" id="meta_title" name="meta_title" placeholder="Enter Meta Title" type="text" value="{{ $seo->meta_title }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="meta_author">Meta Author</label>
                                    <input class="form-control" id="meta_author" name="meta_author" placeholder="Enter Meta Author" type="text" value="{{ $seo->meta_author }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Tag</label>
                                <textarea class="form-control" id="meta_tag" name="meta_tag" rows="4">{{ $seo->meta_tag }}</textarea>
                            </div>
                            <br>
                            <hr>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="4">{{ $seo->meta_description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="google_analytics">Google Analytics</label>
                                <textarea class="form-control" id="google_analytics" name="google_analytics" rows="4">{{ $seo->google_analytics }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="bing_analytics">Bing Analytics</label>
                                <textarea class="form-control" id="bing_analytics" name="bing_analytics" rows="4">{{ $seo->bing_analytics }}</textarea>
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
