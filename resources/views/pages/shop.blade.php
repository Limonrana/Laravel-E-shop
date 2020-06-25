@extends('layouts.app')

@section('title', 'E-SHOP - Product Page')

@section('content')
    <main class="main">
        <div class="banner banner-cat" style="background-image: url('{{ asset('frontend/images/banners/banner-top.jpg') }}');">
            <div class="banner-content container">
                <h1 class="banner-title">
                    Shop Page
                </h1>
            </div><!-- End .banner-content -->
        </div><!-- End .banner -->

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <nav class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-item toolbox-sort">
                                <div class="select-custom">
                                    <select name="orderby" class="form-control">
                                        <option value="menu_order" selected="selected">Default sorting</option>
                                        <option value="popularity">Sort by popularity</option>
                                        <option value="rating">Sort by average rating</option>
                                        <option value="date">Sort by newness</option>
                                        <option value="price">Sort by price: low to high</option>
                                        <option value="price-desc">Sort by price: high to low</option>
                                    </select>
                                </div><!-- End .select-custom -->

                                <a href="#" class="sorter-btn" title="Set Ascending Direction"><span class="sr-only">Set Ascending Direction</span></a>
                            </div><!-- End .toolbox-item -->
                        </div><!-- End .toolbox-left -->

                        <div class="toolbox-item toolbox-show">
                            <label>Showing {{ count($product) }} of {{ count($count) }} results</label>
                        </div><!-- End .toolbox-item -->

                        <div class="layout-modes">
                            <a href="{{ route('shop.page') }}" class="layout-btn btn-grid active" title="Grid">
                                <i class="icon-mode-grid"></i>
                            </a>
                            <a href="#" class="layout-btn btn-list" title="List">
                                <i class="icon-mode-list"></i>
                            </a>
                        </div><!-- End .layout-modes -->
                    </nav>

                    <div class="row row-sm">
                        @foreach($product as $val)
                        <div class="col-6 col-md-4">
                            <div class="product-default">
                                <figure>
                                    <a href="{{ route('single.product.view', [$val->slug, Str::random(150)]) }}">
                                        <img src="{{ $val->featured_image ? asset($val->featured_image) : ' ' }}">
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
                                        <a href="{{ route('single.product.view', [$val->slug, Str::random(150)]) }}" class="btn-quickview" title="Product View"><i class="fas fa-external-link-alt"></i></a>
                                    </div>
                                </div><!-- End .product-details -->
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <nav class="toolbox toolbox-pagination">
                        <div class="toolbox-item toolbox-show">
                            <label>Showing {{ count($product) }} of {{ count($count) }} results</label>
                        </div><!-- End .toolbox-item -->

                        <ul class="pagination">
                            {{ $product->links() }}
                        </ul>
                    </nav>
                </div><!-- End .col-lg-9 -->

                <aside class="sidebar-shop col-lg-3 order-lg-first">
                    <div class="sidebar-wrapper">
                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-1" role="button" aria-expanded="true" aria-controls="widget-body-1">Category</a>
                            </h3>

                            <div class="collapse show" id="widget-body-1">
                                <div class="widget-body">
                                    <ul class="cat-list">
                                        @foreach($category as $val)
                                        <li>
                                            <a href="{{ route('category.taxonomy', [Str::of($val->category_name)->slug('-'), $val->id]) }}">
                                                {{ $val->category_name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

{{--                        <div class="widget">--}}
{{--                            <h3 class="widget-title">--}}
{{--                                <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">Price</a>--}}
{{--                            </h3>--}}

{{--                            <div class="collapse show" id="widget-body-2">--}}
{{--                                <div class="widget-body">--}}
{{--                                    <form action="#">--}}
{{--                                        <div class="price-slider-wrapper">--}}
{{--                                            <div id="price-slider"></div><!-- End #price-slider -->--}}
{{--                                        </div><!-- End .price-slider-wrapper -->--}}

{{--                                        <div class="filter-price-action">--}}
{{--                                            <button type="submit" class="btn btn-primary">Filter</button>--}}

{{--                                            <div class="filter-price-text">--}}
{{--                                                <span id="filter-price-range"></span>--}}
{{--                                            </div><!-- End .filter-price-text -->--}}
{{--                                        </div><!-- End .filter-price-action -->--}}
{{--                                    </form>--}}
{{--                                </div><!-- End .widget-body -->--}}
{{--                            </div><!-- End .collapse -->--}}
{{--                        </div><!-- End .widget -->--}}

                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Capacity</a>
                            </h3>

                            <div class="collapse show" id="widget-body-3">
                                <div class="widget-body">
                                    <ul class="config-size-list">
                                        @foreach($count as $val)
                                            @php
                                            $single = explode(',', $val->product_capacity);
                                            $unique = array_unique($single);
                                            @endphp
                                            @foreach($unique as $row)
                                        <li class="active"><a href="#">{{ $row }}</a></li>
                                        @endforeach
                                        @endforeach
                                    </ul>
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">Brands</a>
                            </h3>

                            <div class="collapse show" id="widget-body-4">
                                <div class="widget-body">
                                    <ul class="cat-list">
                                        @foreach($brand as $val)
                                            @php
                                            $product_count = \App\Models\Admin\Product::where('brand_id', $val->id)->count();
                                            @endphp
                                            @if ($product_count)
                                                <li>
                                                    <a href="{{ route('brand.taxonomy', [Str::of($val->brand_name)->slug('-'), $val->id]) }}">
                                                        {{ $val->brand_name }} <span>{{ $product_count }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-6" role="button" aria-expanded="true" aria-controls="widget-body-6">Color</a>
                            </h3>

                            <div class="collapse show" id="widget-body-6">
                                <div class="widget-body">
                                    <ul class="config-swatch-list">
                                        <li>
                                            <a href="#" style="background-color: #4090d5;"></a>
                                        </li>
                                        <li>
                                            <a href="#" style="background-color: #f5494a;"></a>
                                        </li>
                                    </ul>
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->

                        <div class="widget widget-featured">
                            <h3 class="widget-title">Featured Products</h3>

                            <div class="widget-body">
                                <div class="owl-carousel widget-featured-products">
                                    <div class="featured-col">
                                        @foreach($featured as $val)
                                        <div class="product-default left-details product-widget">
                                            <figure>
                                                <a href="{{ route('single.product.view', [$val->slug, Str::random(150)]) }}">
                                                    <img src="{{ asset($val->featured_image ? $val->featured_image : ' ') }}">
                                                </a>
                                            </figure>
                                            <div class="product-details">
                                                <h2 class="product-title">
                                                    <a href="{{ route('single.product.view', [$val->slug, Str::random(150)]) }}">
                                                        {{ Str::limit($val->product_name, 15) }}
                                                    </a>
                                                </h2>
                                                <div class="ratings-container">
                                                    <div class="product-ratings">
                                                        <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div><!-- End .product-ratings -->
                                                </div><!-- End .product-container -->
                                                <div class="price-box">
                                                    <span class="product-price">${{ $val->selling_price }}</span>
                                                </div><!-- End .price-box -->
                                            </div><!-- End .product-details -->
                                        </div>
                                        @endforeach
                                    </div><!-- End .featured-col -->

                                    <div class="featured-col">
                                        @foreach($featured2 as $val)
                                            <div class="product-default left-details product-widget">
                                                <figure>
                                                    <a href="{{ route('single.product.view', [$val->slug, Str::random(150)]) }}">
                                                        <img src="{{ asset($val->featured_image ? $val->featured_image : ' ') }}">
                                                    </a>
                                                </figure>
                                                <div class="product-details">
                                                    <h2 class="product-title">
                                                        <a href="{{ route('single.product.view', [$val->slug, Str::random(150)]) }}">
                                                            {{ Str::limit($val->product_name, 15) }}
                                                        </a>
                                                    </h2>
                                                    <div class="ratings-container">
                                                        <div class="product-ratings">
                                                            <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div><!-- End .product-ratings -->
                                                    </div><!-- End .product-container -->
                                                    <div class="price-box">
                                                        <span class="product-price">${{ $val->selling_price }}</span>
                                                    </div><!-- End .price-box -->
                                                </div><!-- End .product-details -->
                                            </div>
                                       @endforeach
                                    </div><!-- End .featured-col -->
                                </div><!-- End .widget-featured-slider -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .widget -->

                        <div class="widget widget-block">
                            <h3 class="widget-title">Custom HTML Block</h3>
                            <h5>This is a custom sub-title.</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi. </p>
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar-wrapper -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->
@endsection
