@extends('layouts.app')
@section('title', 'E-SHOP - Change Customer Password')
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Password Change</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 order-lg-last dashboard-content pt-2 pb-5">
                    <h2>Password Change</h2>
                    <div class="alert alert-success" role="alert">
                        Hello, <strong>{{ Auth::user()->name }}! </strong> You can change your password from here. Please Put everything is correctly and update.
                    </div><!-- End .alert -->

                    <div class="mb-2"></div><!-- margin -->
                <div class="card">
                    <div class="card-header">{{ __('Change Your Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('change.password.update') }}">
                            @csrf

{{--                            <input type="hidden" name="token" value="{{ $token }}">--}}

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                                <div class="col-md-6">
                                    <input id="oldpass" type="password" class="form-control @error('oldpass') is-invalid @enderror" name="oldpass" value="{{ $oldpass ?? old('oldpass') }}" required autocomplete="oldpass" autofocus>

                                    @error('oldpass')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Change Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('customer-dashboard/partials/sidebar')
        </div>
    </div>
    <div class="mb-5"></div><!-- margin -->
</main><!-- End .main -->
@endsection
