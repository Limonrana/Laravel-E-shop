@extends('layouts.app')

@section('title', 'E-SHOP - Taxonomy Page')

@section('content')
    <main class="main">
        <div class="banner banner-cat" style="background-image: url('{{ asset('frontend/images/banners/banner-top.jpg') }}');">
            <div class="banner-content container">
                <h1 class="banner-title">
                    {{ $title }}
                </h1>
            </div><!-- End .banner-content -->
        </div><!-- End .banner -->

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a>Category</a></li>
                    @if (Request::is('shop/category/subcategory/*'))
                        <li class="breadcrumb-item">
                            <a href="{{ route('category.taxonomy', [Str::of($subcategory->get_category->category_name)->slug('-'), $subcategory->category_id]) }}">
                                {{ $subcategory->get_category->category_name }}
                            </a>
                        </li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
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
                    <a href="category.html" class="layout-btn btn-grid active" title="Grid">
                        <i class="icon-mode-grid"></i>
                    </a>
                    <a href="category-list.html" class="layout-btn btn-list" title="List">
                        <i class="icon-mode-list"></i>
                    </a>
                </div><!-- End .layout-modes -->
            </nav>

            <div class="row row-sm">
                @foreach($product as $val)
                <div class="col-6 col-md-4 col-xl-5col">
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
                            <div class="product-action">
                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal" data-id="{{ $val->id }}"><i class="icon-bag"></i>ADD TO CART</button>
                                <a href="{{ route('quick.view') }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
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
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->
@endsection
