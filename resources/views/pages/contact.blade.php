@extends('layouts.app')

@section('title', 'E-SHOP - Contact Us')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div id="map"></div><!-- End #map -->

            <div class="row">
                <div class="col-md-8">
                    <h2 class="light-title">Write <strong>Us</strong></h2>

                    <form action="{{ route('contact.mail') }}" method="POST">
                        @csrf
                        <div class="form-group required-field">
                            <label for="contact-name">Name</label>
                            <input type="text" class="form-control" id="contact-name" name="contact_name" required>
                        </div><!-- End .form-group -->

                        <div class="form-group required-field">
                            <label for="contact-email">Email</label>
                            <input type="email" class="form-control" id="contact-email" name="contact_email" required>
                        </div><!-- End .form-group -->

                        <div class="form-group">
                            <label for="contact-phone">Phone Number</label>
                            <input type="tel" class="form-control" id="contact-phone" name="contact_phone">
                        </div><!-- End .form-group -->

                        <div class="form-group required-field">
                            <label for="contact-message">What’s on your mind?</label>
                            <textarea cols="30" rows="1" id="contact-message" class="form-control" name="contact_message" required></textarea>
                        </div><!-- End .form-group -->

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div><!-- End .form-footer -->
                    </form>
                </div><!-- End .col-md-8 -->

                <div class="col-md-4">
                    <h2 class="light-title">Contact <strong>Details</strong></h2>

                    <div class="contact-info">
                        <div>
                            <i class="icon-phone"></i>
                            <p><a href="tel:">0201 203 2032</a></p>
                            <p><a href="tel:">0201 203 2032</a></p>
                        </div>
                        <div>
                            <i class="icon-mobile"></i>
                            <p><a href="tel:">201-123-3922</a></p>
                            <p><a href="tel:">302-123-3928</a></p>
                        </div>
                        <div>
                            <i class="icon-mail-alt"></i>
                            <p><a href="mailto:limonrana515@gmail.com">limonrana515@gmail.com</a></p>
                            <p><a href="mailto:contact@e-shop.com">contact@e-shop.com</a></p>
                        </div>
                        <div>
                            <i class="icon-skype"></i>
                            <p>eshop_skype</p>
                            <p>CEO_eshop15</p>
                        </div>
                    </div><!-- End .contact-info -->
                </div><!-- End .col-md-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-8"></div><!-- margin -->
    </main><!-- End .main -->
@endsection

@section('js')
    <!-- Google Map-->
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDc3LRykbLB-y8MuomRUIY0qH5S6xgBLX4"></script>
    <script src="{{ asset('frontend/js/map.js') }}"></script>
@endsection
