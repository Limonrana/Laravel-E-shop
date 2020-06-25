@extends('layouts.app')

@section('title', 'E-SHOP - My Account')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">My-Account</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-last dashboard-content">
                    <h2>Edit Account Information</h2>

                            <form action="{{ route('customer.profile.update', $profile->id) }}" method="post">
                                @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-4 required-field">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control text-dark" name="name" id="name" placeholder="Enter your full name" value="{{ $profile->name }}">
                                        </div><!-- End .form-group -->

                                        <div class="form-group col-md-4 required-field">
                                            <label for="email">Email</label>
                                            @if ($profile->provider)
                                                <input class="form-control" type="text" name="email" value="{{ $profile->email }}" readonly>
                                                <small>You can't change this email with social login.</small>
                                            @else
                                                <input type="email" class="form-control text-dark" name="email" id="email" placeholder="Enter your email" value="{{ $profile->email }}">
                                            @endif
                                        </div><!-- End .form-group -->
                                        <div class="form-group col-md-4 required-field">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control text-dark" name="phone" id="phone" placeholder="Enter your phone" value="{{ $profile->phone }}">
                                        </div><!-- End .form-group -->
                                    </div><!-- End .form-row -->
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="address_1">Address</label>
                                            <input type="text" class="form-control text-dark" name="address_1" id="address_1" placeholder="1234 Main St" value="{{ $profile->address_1 }}">
                                        </div><!-- End .form-group -->

                                        <div class="form-group col-md-6">
                                            <label for="address_2">Address 2</label>
                                            <input type="text" class="form-control text-dark" name="address_2" id="address_2" placeholder="Apartment, studio, or floor" value="{{ $profile->address_2 }}">
                                        </div><!-- End .form-group -->
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control text-dark" name="city" id="city" value="{{ $profile->city }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control text-dark" name="state" id="state" value="{{ $profile->state }}">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control text-dark" name="country" id="country" value="{{ $profile->country }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="zip">Zip</label>
                                            <input type="text" class="form-control text-dark" name="zip" id="zip" value="{{ $profile->zip }}">
                                        </div>
                                    </div>

                                    <div class="mb-2"></div><!-- margin -->

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="change-pass-checkbox" value="1">
                                        <label class="custom-control-label" for="change-pass-checkbox">Change Password</label>
                                    </div><!-- End .custom-checkbox -->

                                    <div id="account-chage-pass">
                                        <h3 class="mb-2">Change Password</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group required-field">
                                                    <label for="acc-pass2">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password">
                                                </div><!-- End .form-group -->
                                            </div><!-- End .col-md-6 -->

                                            <div class="col-md-6">
                                                <div class="form-group required-field">
                                                    <label for="acc-pass3">Confirm Password</label>
                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                                </div><!-- End .form-group -->
                                            </div><!-- End .col-md-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End #account-chage-pass -->

                                    <div class="required text-right">* Required Field</div>
                                    <div class="form-footer">
                                        <a href="#"><i class="icon-angle-double-left"></i>Back</a>

                                        <div class="form-footer-right">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div><!-- End .form-footer -->
                                </form>
                            </div><!-- End .col-lg-9 -->
                            @include('customer-dashboard/partials/sidebar')
                        </div><!-- End .row -->
                    </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->
@endsection
