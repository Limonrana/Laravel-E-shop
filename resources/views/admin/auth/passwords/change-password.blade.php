@extends('admin.layouts.app')

@section('title', 'E-SHOP - Change password')

@section('content')
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">E-SHOP</a>
            <span class="breadcrumb-item active">Change Password</span>
        </nav>

  <div class="sl-pagebody">

    <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">{{ __('Change Admin Password') }}</h6>
        <div class="form-layout">
            <div class="row mg-b-25">
                <div class="col-lg-4">
                    <form method="POST" action="{{ url('admin/password/update') }}">
                        @csrf
                    <div class="form-group">
                        <label class="form-control-label">{{ __('Old Password') }} <span class="tx-danger">*</span></label>
                        <input id="oldpass" type="password" class="form-control @error('oldpass') is-invalid @enderror" name="oldpass" value="{{ $oldpass ?? old('oldpass') }}" required placeholder="Enter Old Password" autofocus>

                        @error('oldpass')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">{{ __('New Password') }} <span class="tx-danger">*</span></label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Enter New Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">{{ __('Confirm Password') }} <span class="tx-danger">*</span></label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Enter Confirm Password">
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->

            <div class="form-layout-footer">
                <button id="change" type="submit" class="btn btn-info mg-r-5">{{ __('Change Password') }}</button>
                <a href="#" class="btn btn-secondary">Cancel</a>
            </div><!-- form-layout-footer -->
        </form>
        </div><!-- form-layout -->
    </div><!-- card -->
  </div>
</div>
@endsection
