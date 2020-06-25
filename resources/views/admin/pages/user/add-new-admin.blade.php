@extends('admin.layouts.app')
@section('title', 'Add New Admin | E-SHOP')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">E-SHOP</a>
        <span class="breadcrumb-item active">Add New Admin</span>
    </nav>
    <div class="sl-pagebody">
        <div class="row row-sm mg-t-20">
            <div class="col-xl-9">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <h6 class="card-body-title">Add New Admin</h6>
                    <form class="mt-4" action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Your Name" type="text">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email" type="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password" type="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><br>
                        <h6>Permission</h6>
                        <hr>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="posts" value="1"><span>Posts</span>
                                    </label>
                                </div><!-- col-3 -->
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label class="ckbox">
                                        <input type="checkbox" name="pages" value="1"><span>Pages</span>
                                    </label>
                                </div><!-- col-3 -->
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label class="ckbox">
                                        <input type="checkbox" name="comments" value="1"><span>Comments</span>
                                    </label>
                                </div><!-- col-3 -->
                            </div><!-- row -->
                            <div class="row mg-t-10">
                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="reviews" value="1"><span>Reviews</span>
                                    </label>
                                </div><!-- col-3 -->
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label class="ckbox">
                                        <input type="checkbox" name="coupons" value="1"><span>Coupons</span>
                                    </label>
                                </div><!-- col-3 -->
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label class="ckbox">
                                        <input type="checkbox" name="ecommerce" value="1"><span>E-commerce</span>
                                    </label>
                                </div><!-- col-3 -->
                            </div><!-- row -->
                            <div class="row mg-t-10">
                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="orders" value="1"><span>Orders</span>
                                    </label>
                                </div><!-- col-3 -->
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label class="ckbox">
                                        <input type="checkbox" name="products" value="1"><span>Products</span>
                                    </label>
                                </div><!-- col-3 -->
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label class="ckbox">
                                        <input type="checkbox" name="theme_panel" value="1"><span>Theme Panel</span>
                                    </label>
                                </div><!-- col-3 -->
                            </div><!-- row -->
                            <div class="row mg-t-10">
                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="mail" value="1"><span>Mail Setting</span>
                                    </label>
                                </div><!-- col-3 -->
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label class="ckbox">
                                        <input type="checkbox" name="widgets" value="1"><span>Widgets</span>
                                    </label>
                                </div><!-- col-3 -->
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label class="ckbox">
                                        <input type="checkbox" name="users" value="1"><span>Users</span>
                                    </label>
                                </div><!-- col-3 -->
                            </div><!-- row -->
                            <div class="row mg-t-10">
                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="tools" value="1"><span>Tools</span>
                                    </label>
                                </div><!-- col-3 -->
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label class="ckbox">
                                        <input type="checkbox" name="settings" value="1"><span>Settings</span>
                                    </label>
                                </div><!-- col-3 -->
                                <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                                    <label class="ckbox">
                                        <input type="checkbox" name="create_admin" value="1"><span>Create Admin</span>
                                    </label>
                                </div><!-- col-3 -->
                            </div><!-- row -->
                        </div>
                </div><!-- card -->
            </div><!-- col-6 -->
            <div class="col-xl-3 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Avatar</h6>
                    <div class="custom-file">
                        <input class="custom-file-input form-control @error('avatar') is-invalid @enderror" id="avatar" onchange="document.getElementById('avatar_show').src = window.URL.createObjectURL(this.files[0])" name="avatar" type="file">
                        <span class="custom-file-control custom-file-control-inverse"></span>
                        @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="preview_image mt-3">
                        <img id="avatar_show" width="300px" style="border: 1px solid black">
                    </div>
                    <div class="row mg-t-30 text-right">
                        <div class="col-sm-12">
                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div><!-- form-layout-footer -->
                        </div><!-- col-8 -->
                    </div>
                  </form>
                </div><!-- card -->
            </div><!-- col-6 -->
        </div><!-- row -->
    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

@endsection
