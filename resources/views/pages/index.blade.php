@extends('layouts.app')

@section('title', 'E-SHOP - Our Best World Wide Shop')

@section('content')
    <main class="main">
        <div class="home-top-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="home-slider owl-carousel owl-carousel-lazy">
                            @foreach($slider as $val)
                            <div class="home-slide">
                                <div class="owl-lazy slide-bg" data-src="{{ asset($val->slider_image) }}"></div>
                                <div class="home-slide-content text-white">
                                    <h3>{{ $val->subtitle }}</h3>
                                    <h1>{{ $val->title }}</h1>
                                    <p>{{ $val->description }}</p>
                                    <a href="{{ $val->button_url }}" class="btn @if($val->button_bg == 'Theme Default') btn-dark @else {{ $val->button_bg  }} text-white @endif">{{ $val->button_text }}</a>
                                </div><!-- End .home-slide-content -->
                            </div><!-- End .home-slide -->
                            @endforeach
                        </div><!-- End .home-slider -->
                    </div><!-- End .col-lg-9 -->

                    <div class="col-lg-3 order-lg-first">
                        <div class="side-custom-menu">
                            <h2>TOP CATEGORIES</h2>

                            <div class="side-menu-body">
                                <ul>
                                    @foreach($category as $val)
                                    <li>
                                        <a href="{{ route('category.taxonomy', [Str::of($val->category_name)->slug('-'), $val->id]) }}">
                                            <span><i class="{{ $val->category_icon }}"></i></span> {{ $val->category_name }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>

{{--                                <a href="#" class="btn btn-block btn-primary">HUGE SALE - <strong>70%</strong> Off</a>--}}
                            </div><!-- End .side-menu-body -->
                        </div><!-- End .side-custom-menu -->
                    </div><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .home-top-container -->




        <div class="info-boxes-container">
            <div class="container">
                <div class="info-box">
                    <i class="@if($home->info_icon_1 == 'icon-shipping' ) @elseif($home->info_icon_1 == 'icon-us-dollar') @elseif($home->info_icon_1 == 'icon-support') @else fa @endif {{ $home->info_icon_1 }}"></i>

                    <div class="info-box-content">
                        <h4>{{ $home->info_title_1 }}</h4>
                        <p>{{ $home->info_subtitle_1 }}</p>
                    </div><!-- End .info-box-content -->
                </div><!-- End .info-box -->

                <div class="info-box">
                        <i class="@if($home->info_icon_2 == 'icon-shipping' ) @elseif($home->info_icon_2 == 'icon-us-dollar') @elseif($home->info_icon_2 == 'icon-support') @else fa @endif {{ $home->info_icon_2 }}"></i>

                    <div class="info-box-content">
                        <h4>{{ $home->info_title_2 }}</h4>
                        <p>{{ $home->info_subtitle_2 }}</p>
                    </div><!-- End .info-box-content -->
                </div><!-- End .info-box -->

                <div class="info-box">
                        <i class="@if($home->info_icon_3 == 'icon-shipping' ) @elseif($home->info_icon_3 == 'icon-us-dollar') @elseif($home->info_icon_3 == 'icon-support') @else fa @endif {{ $home->info_icon_3 }}"></i>

                    <div class="info-box-content">
                        <h4>{{ $home->info_title_3 }}</h4>
                        <p>{{ $home->info_subtitle_3 }}</p>
                    </div><!-- End .info-box-content -->
                </div><!-- End .info-box -->
            </div><!-- End .container -->
        </div><!-- End .info-boxes-container -->

        <div class="banners-group">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{ asset($home->left_banner_1) }}" alt="banner">
                            </a>
                        </div><!-- End .banner -->

                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{ asset($home->left_banner_2) }}" alt="banner">
                            </a>
                        </div><!-- End .banner -->

                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{ asset($home->left_banner_3) }}" alt="banner">
                            </a>
                        </div><!-- End .banner -->
                    </div><!-- End .col-lg-3 -->

                    <div class="col-lg-3 col-sm-6 order-lg-last">
                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{ asset($home->right_banner_1) }}" alt="banner">
                            </a>
                        </div><!-- End .banner -->

                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{ asset($home->right_banner_2) }}" alt="banner">
                            </a>
                        </div><!-- End .banner -->

                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{ asset($home->right_banner_3) }}" alt="banner">
                            </a>
                        </div><!-- End .banner -->
                    </div><!-- End .col-lg-3 -->

                    <div class="col-lg-6">
                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{ asset($home->mid_banner_1) }}" alt="banner">
                            </a>
                        </div><!-- End .banner -->

                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{ asset($home->mid_banner_2) }}" alt="banner">
                            </a>
                        </div><!-- End .banner -->

                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{ asset($home->mid_banner_3) }}" alt="banner">
                            </a>
                        </div><!-- End .banner -->
                    </div><!-- End .col-lg-6 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .banners-group -->

        <div class="mb-4"></div><!-- margin -->

        <section class="featured-section">
            <div class="container">
                <h2 class="carousel-title">Featured Products</h2>
                <div class="product-intro owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                        'margin': 20,
                        'items': 2,
                        'autoplayTimeout': 5000,
                        'responsive': {
                            '559': {
                                'items': 3
                            },
                            '975': {
                                'items': 4
                            }
                        }
                    }">

                    @foreach($featured as $val)
                    <div class="product-default">
                        <figure>
                            <a href="{{ route('single.product.view', [$val->slug, Str::random(150)]) }}">
                                <img src="{{ asset($val->featured_image ? $val->featured_image : '') }}">
                            </a>
                        </figure>
                        <div class="product-details">
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <h2 class="product-title">
                                <a href="{{ route('single.product.view', [$val->slug, Str::random(150)]) }}">
                                    {{ Str::limit($val->product_name, 30) }}
                                </a>
                            </h2>
                            <div class="price-box">
                                @if ($val->discount_price)
                                <span class="product-price" style="text-decoration: line-through;">${{ $val->selling_price }}</span>
                                <span class="product-price">${{ $val->discount_price }}</span>
                                @else
                                    <span class="product-price">${{ $val->selling_price }}</span>
                                @endif
                            </div><!-- End .price-box -->
                            @php
                                $wishlist_check = \App\Models\Frontend\Wishlist::where('user_id', \Illuminate\Support\Facades\Auth::id())
                                                ->where('product_id', $val->id)->first();
                            @endphp
                            <div class="product-action">
                                @if($wishlist_check)
                                    <a class="btn-icon-wish wishlist" data-id="{{ $val->id }}"><i class="fa fa-heart text-danger"></i></a>
                                @else
                                    <a class="btn-icon-wish wishlist" data-id="{{ $val->id }}"><i class="icon-heart text-danger"></i></a>
                                @endif
                                <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal" data-id="{{ $val->id }}"><i class="icon-bag"></i>ADD TO CART</button>
                                <a href="{{ route('single.product.view', [$val->slug, Str::random(150)]) }}" class="btn-quickview" title="Product View">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div><!-- End .product-details -->
                    </div>
                  @endforeach
                </div>
            </div>
        </section>
    </main><!-- End .main -->
@endsection

{{--    Quick View Ajax--}}
<script>
    function quickview(id) {
        $.ajax({
            url: '/product/quick/view/' + id,
            type: "GET",
            data_type: "json",
            success: function (data) {
                $('#p_name').text(data.product.product_name);
                $('#p_des').text(data.product.short_description);
                $('#f_image').attr('src',data.product.featured_image);
                $('#g_image1').attr('src',data.product.gallery_image_1);
                $('#g_image2').attr('src',data.product.gallery_image_2);
                $('#f_image1').attr('src',data.product.featured_image);
                $('#g_image11').attr('src',data.product.gallery_image_1);
                $('#g_image22').attr('src',data.product.gallery_image_2);
                $('#product_id').val(data.product.id);

                var discount = data.product.discount_price;
                if (discount){
                    $('#s_price').text(data.product.discount_price);
                }
                else {
                    $('#s_price').text(data.product.selling_price);
                }

                var d = $('select[name="size"]').empty();
                $.each(data.size, function (key, value) {
                    if (value) {
                        $('select[name="size"]').append('<option value="'+value+'">'+value+'</option>');
                    }
                    else {
                        $('select[name="size"]').append('<option value="No-Size">No Size Variation</option>');
                    }
                });

                var d = $('select[name="color"]').empty();
                $.each(data.color, function (key, value) {
                    if(value){
                        $('select[name="color"]').append('<option value="'+value+'">'+value+'</option>');
                    }
                    else {
                        $('select[name="color"]').append('<option value="No-Color">No Color Variation</option>');
                    }
                });

                var d = $('select[name="capacity"]').empty();
                $.each(data.capacity, function (key, value) {
                    if (value) {
                        $('select[name="capacity"]').append('<option value="'+value+'">'+value+'</option>');
                    }
                    else {
                        $('select[name="capacity"]').append('<option value="No-Capacity">No Capacity Variation</option>');
                    }
                });
            }
        })
    }
</script>
