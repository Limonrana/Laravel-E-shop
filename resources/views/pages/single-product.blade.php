@extends('layouts.app')

@section('title', 'E-SHOP - Single Product')

@section('content')

    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.taxonomy', [Str::of($single_product->get_category->category_name)->slug('-'), $single_product->category_id]) }}">
                            {{ $single_product->get_category->category_name }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $single_product->get_subcategory->subcategory_name }}
                    </li>
                </ol>
            </div><!-- End .container -->
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="product-single-container product-single-default">
                        <div class="row">
                            <div class="col-lg-7 col-md-6 product-single-gallery">
                                <div class="product-slider-container product-item">
                                    <div class="product-single-carousel owl-carousel owl-theme">
                                        <div class="product-item">
                                            <img class="product-single-image" src="{{ asset($single_product->featured_image) }}" data-zoom-image="{{ asset($single_product->featured_image) }}"/>
                                        </div>
                                        @if ($single_product->gallery_image_1)
                                            <div class="product-item">
                                                <img class="product-single-image" src="{{ asset($single_product->gallery_image_1) }}" data-zoom-image="{{ asset($single_product->gallery_image_1) }}"/>
                                            </div>
                                        @else
                                        @endif
                                        @if ($single_product->gallery_image_2)
                                        <div class="product-item">
                                            <img class="product-single-image" src="{{ asset($single_product->gallery_image_2) }}" data-zoom-image="{{ asset($single_product->gallery_image_2) }}"/>
                                        </div>
                                        @else
                                        @endif
                                    </div>
                                    <!-- End .product-single-carousel -->
                                    <span class="prod-full-screen">
                                            <i class="icon-plus"></i>
                                        </span>
                                </div>
                                <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>
                                    <div class="col-3 owl-dot">
                                        <img src="{{ asset($single_product->featured_image) }}"/>
                                    </div>
                                    @if ($single_product->gallery_image_1)
                                        <div class="col-3 owl-dot">
                                            <img src="{{ asset($single_product->gallery_image_1) }}"/>
                                        </div>
                                    @else
                                    @endif
                                    @if ($single_product->gallery_image_2)
                                    <div class="col-3 owl-dot">
                                        <img src="{{ asset($single_product->gallery_image_2) }}"/>
                                    </div>
                                    @else
                                    @endif
                                </div>
                            </div><!-- End .col-lg-7 -->

                            <div class="col-lg-5 col-md-6">
                                <div class="product-single-details">
                                    <h1 class="product-title">{{ $single_product->product_name }}</h1>

                                    @php
                                        $check_rate = \App\Models\Frontend\Review::where('product_id', $single_product->id)->get();
                                            if (count($check_rate)) {
                                            $count_r = \App\Models\Frontend\Review::where('product_id', $single_product->id)->count();
                                            $ratings_top = \App\Models\Frontend\Review::where('product_id', $single_product->id)->sum('ratings');
                                            $value_top = \App\Models\Frontend\Review::where('product_id', $single_product->id)->sum('value');
                                            $price_top = \App\Models\Frontend\Review::where('product_id', $single_product->id)->sum('price');
                                            $whole_top = $ratings_top + $value_top + $price_top;
                                            $whole2_top = $whole_top / $count_r;
                                            $whole3_top = $whole2_top / 3;
                                            $new_total_top = round($whole3_top, 1);
                                            if ($new_total_top < 1 ) {
                                                $width = "0%";
                                            }
                                            elseif ($new_total_top < 1.4) {
                                                $width = "29%";
                                            }
                                            elseif ($new_total_top < 2.4) {
                                                $width = "49%";
                                            }
                                            elseif ($new_total_top < 3.4) {
                                                $width = "69%";
                                            }
                                            elseif ($new_total_top < 4.4) {
                                                $width = "89%";
                                            }
                                            elseif ($new_total_top == 5) {
                                                $width = "100%";
                                            }
                                            else {
                                                $width = "100%";
                                            }
                                    }
                                    @endphp

                                    @if (count($check_rate))
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:{{ $width }}"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                            <a href="" class="rating-link">
                                                <a href="" class="rating-link">
                                                    @if ($count_r <= 1)
                                                        ( {{ $count_r }} Review )
                                                    @elseif ($count_r >= 2)
                                                        ( {{ $count_r }} Reviews )
                                                    @elseif($count_r == 0)
                                                        ( 0 Review )
                                                    @endif
                                                </a>
                                            </a>
                                        </div><!-- End .product-container -->
                                    @else
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:0%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                            <a href="#" class="rating-link">
                                                <a href="#" class="rating-link">( 0 Review )</a>
                                            </a>
                                        </div><!-- End .product-container -->
                                    @endif

                                    <div class="price-box">
                                        @if ($single_product->discount_price)
                                            <span class="old-price">${{ $single_product->selling_price }}</span>
                                            <span class="product-price">${{ $single_product->discount_price }}</span>
                                        @else
                                            <span class="product-price">${{ $single_product->selling_price }}</span>
                                        @endif
                                    </div><!-- End .price-box -->

                                    @php
                                        if ($single_product->product_color && $single_product->product_capacity)
                                        {
                                            $col_2 = "col-md-6";
                                        }
                                        elseif ($single_product->product_size)
                                        {
                                            $col_2 = "col-md-12";
                                        }
                                        elseif ($single_product->product_capacity)
                                        {
                                            $col_2 = "col-md-12";
                                        }
                                        else
                                        {
                                            $col_2 = "col-md-12";
                                        }
                                    @endphp
                                    <div class="product-desc">
                                        <p>{{ $single_product->short_description }}</p>
                                    </div><!-- End .product-desc -->
                                    <form action="{{ route('products.add.cart', $single_product->id) }}" method="post">
                                        @csrf
                                    <div class="product-filters-container">
                                        <div class="product-single-filter">
                                            <div class="col-md-12">
                                                <div class="row" style="margin-left: -30px; margin-right: -30px">
                                                    @if ($single_product->product_color)
                                                        <div class="form-group {{$col_2}}">
                                                            <select class="form-control my-select" name="color">
                                                                <option>Color</option>
                                                                @foreach($single_color as $val)
                                                                    <option value="{{ $val }}">{{ $val }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @else
                                                    @endif
                                                    @if ($single_product->product_capacity)
                                                        <div class="form-group {{$col_2}}">
                                                            <select class="form-control my-select" name="capacity">
                                                                <option>Capacity</option>
                                                                    @foreach($single_cap as $val)
                                                                        <option value="{{ $val }}">{{ $val }}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                    @else
                                                    @endif
                                                </div>
                                            </div>
                                        </div><!-- End .product-single-filter -->
                                    </div><!-- End .product-filters-container -->

                                    <div class="sticky-header">
                                        <div class="container">
                                            <div class="sticky-img">
                                                <img src="{{ asset($single_product->featured_image) }}" />
                                            </div>
                                            <div class="sticky-detail">
                                                <div class="sticky-product-name">
                                                    <h2 class="product-title mt-1">{{ Str::limit($single_product->product_name, 80) }}</h2>
                                                    <div class="price-box">
                                                        @if ($single_product->discount_price)
                                                            <span class="old-price">${{ $single_product->selling_price }}</span>
                                                            <span class="product-price">${{ $single_product->discount_price }}</span>
                                                        @else
                                                            <span class="product-price">${{ $single_product->selling_price }}</span>
                                                        @endif
                                                    </div><!-- End .price-box -->
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="product-ratings">
                                                        <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                                                    </div><!-- End .product-ratings -->

                                                    <a href="#" class="rating-link"> ( In stock ) </a>
                                                </div><!-- End .product-container -->
                                            </div><!-- End .sticky-detail -->
                                            <a href="cart.html" class="paction add-cart" title="Add to Cart">
                                                <span>Add to Cart</span>
                                            </a>
                                        </div><!-- end .container -->
                                    </div><!-- end .sticky-header -->

                                    <div class="product-action product-all-icons">
                                        <div class="product-single-qty">
                                            <input class="horizontal-quantity form-control" name="qty" type="text">
                                        </div><!-- End .product-single-qty -->

                                        <button class="paction add-cart" title="Add to Cart">
                                            <span>Add to Cart</span>
                                        </button>
                                        <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                                            <span>Add to Wishlist</span>
                                        </a>
                                        <a href="#" class="paction add-compare" title="Add to Compare">
                                            <span>Add to Compare</span>
                                        </a>
                                    </div><!-- End .product-action -->
                                    </form>

                                    <div class="product-single-share">
                                        <label>Share:</label>
                                        <!-- www.addthis.com share plugin-->
                                        <div class="addthis_inline_share_toolbox"></div>
                                    </div><!-- End .product single-share -->
                                </div><!-- End .product-single-details -->
                            </div><!-- End .col-lg-5 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-single-container -->

                    <div class="product-single-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content" role="tab" aria-controls="product-tags-content" aria-selected="false">Specifications</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                                <div class="product-desc-content">
                                   {!! $single_product->product_description !!}
                                </div><!-- End .product-desc-content -->
                            </div><!-- End .tab-pane -->

                            <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                                <div class="product-tags-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>In Stock: <b>{{ $single_product->product_quantity }} QTY</b></p>
                                            @if ($single_product->product_color)
                                                <p>Color: <b>@foreach($single_color as $val)
                                                            {{ $val }},
                                                        @endforeach</b>
                                                </p>
                                            @else
                                            @endif

                                            @if ($single_product->product_capacity)
                                                 <p>Capacity: <b>@foreach($single_cap as $val)
                                                                {{ $val }},
                                                            @endforeach</b>
                                                 </p>
                                            @else
                                            @endif
                                            @if ($single_product->product_size)
                                                  <p>Size: <b>@foreach($single_size as $val)
                                                                {{ $val }},
                                                            @endforeach</b>
                                                  </p>
                                            @else
                                            @endif

                                            <p>{{ $single_product->short_description }}</p>

                                        </div><!-- End .col-md-12 -->
                                    </div>
                                </div><!-- End .product-tags-content -->
                            </div><!-- End .tab-pane -->

                            <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                                <div class="product-reviews-content">
                                    <div class="collateral-box">
                                        <!-- ALL REVIEW HERE -->
                                        <div class="review-view pt-5" style="margin-bottom: 20px; background: #0088cc0d;">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <h3>Ratings & Reviews</h3>
                                                        <div class="container-fluid px-1 mx-auto">
                                                            <div class="row justify-content-center">
                                                                <div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center">
                                                                    <div class="alert alert-danger text-left" role="alert">
                                                                        Only customers who have purchased this product may leave a review.
                                                                    </div>

                                                                    @php
                                                                        $check = \App\Models\Frontend\Review::where('product_id', $single_product->id)->get();
                                                                        if (count($check)) {
                                                                        $ratings = \App\Models\Frontend\Review::where('product_id', $single_product->id)->sum('ratings');
                                                                        $value = \App\Models\Frontend\Review::where('product_id', $single_product->id)->sum('value');
                                                                        $price = \App\Models\Frontend\Review::where('product_id', $single_product->id)->sum('price');
                                                                        $excellent = \App\Models\Frontend\Review::where('product_id', $single_product->id)->where('ratings', 5)->count();
                                                                        $good = \App\Models\Frontend\Review::where('product_id', $single_product->id)->where('ratings', 4)->count();
                                                                        $average = \App\Models\Frontend\Review::where('product_id', $single_product->id)->where('ratings', 3)->count();
                                                                        $poor = \App\Models\Frontend\Review::where('product_id', $single_product->id)->where('ratings', 2)->count();
                                                                        $terrible = \App\Models\Frontend\Review::where('product_id', $single_product->id)->where('ratings', 1)->count();
                                                                        $count = \App\Models\Frontend\Review::where('product_id', $single_product->id)->count();
                                                                        $whole = $ratings + $value + $price;
                                                                        $whole2 = $whole / $count;
                                                                        $whole3 = $whole2 / 3;
                                                                        $new_total = round($whole3, 1);
                                                                    @endphp
                                                                    <div class="card" style="padding-top: 20px; padding-bottom: 20px;">
                                                                        <div class="row justify-content-left d-flex">
                                                                            <div class="col-md-4 d-flex flex-column">
                                                                                <div class="rating-box">
                                                                                    <h1 class="pt-4">{{ $new_total }}</h1>
                                                                                    <p class="">out of 5</p>
                                                                                </div>
                                                                                <div> <span class="fa fa-star @if($new_total < 1) @else star-active @endif mx-1"></span>
                                                                                    <span class="fa fa-star @if($new_total < 1.3) @else star-active @endif mx-1"></span>
                                                                                    <span class="fa fa-star @if($new_total < 2.3) @else star-active @endif mx-1"></span>
                                                                                    <span class="fa fa-star @if($new_total < 3.3) @else star-active @endif mx-1"></span>
                                                                                    <span class="fa fa-star @if($new_total < 4.4) @else star-active @endif mx-1"></span> </div>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="rating-bar0 justify-content-center">
                                                                                    <table class="text-left mx-auto">
                                                                                        <tr>
                                                                                            <td class="rating-label">Excellent</td>
                                                                                            <td class="rating-bar">
                                                                                                <div class="bar-container">
                                                                                                    <div class="bar-5"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="text-right">{{ $excellent }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="rating-label">Good</td>
                                                                                            <td class="rating-bar">
                                                                                                <div class="bar-container">
                                                                                                    <div class="bar-4"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="text-right">{{ $good }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="rating-label">Average</td>
                                                                                            <td class="rating-bar">
                                                                                                <div class="bar-container">
                                                                                                    <div class="bar-3"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="text-right">{{ $average }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="rating-label">Poor</td>
                                                                                            <td class="rating-bar">
                                                                                                <div class="bar-container">
                                                                                                    <div class="bar-2"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="text-right">{{ $poor }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="rating-label">Terrible</td>
                                                                                            <td class="rating-bar">
                                                                                                <div class="bar-container">
                                                                                                    <div class="bar-1"></div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="text-right">{{ $terrible }}</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @php
                                                                    }
                                                                    $feedback = \App\Models\Frontend\Review::where('product_id', $single_product->id)->get();
                                                                    @endphp

                                                                    @forelse($feedback as $val)
                                                                    <div class="card">
                                                                        <p class="content text-left" style="padding: 15px 15px 0px 15px;">
                                                                            {{ $val->review }}
                                                                        </p>
                                                                        <div class="col-md-12">
                                                                            <div class="row">
                                                                                <div class="col-md-8">
                                                                                    @php
                                                                                    $review_count = $val->ratings + $val->value + $val->price;
                                                                                    $total = round($review_count / 3, 1);
                                                                                    @endphp
                                                                                    <h5 class="mb-0 text-left">{{ $val->user->name }}</h5>
                                                                                    <p class="text-left" style="margin-left: -10px; margin-bottom: 0px;">
                                                                                        <span class="fa fa-star @if($total < 1) @else star-active @endif ml-3"></span>
                                                                                        <span class="fa fa-star @if($total < 1.4) @else star-active @endif"></span>
                                                                                        <span class="fa fa-star @if($total < 2.4) @else star-active @endif"></span>
                                                                                        <span class="fa fa-star @if($total < 3.4) @else star-active @endif"></span>
                                                                                        <span class="fa fa-star @if($total < 4.4) @else star-active @endif"></span>
                                                                                        <span class="text-muted" style="margin-left: 5px;"><b>{{ $total }}</b></span>
                                                                                    </p>
                                                                                    <p class="text-left">
                                                                                        <span class="badge badge-success">Verified Purchase</span>
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <p class="pt-5 pt-sm-3 text-right">{{ $val->created_at ? $val->created_at->diffForHumans() : "N/A" }}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @empty
                                                                        <div class="card">
                                                                            <p class="content text-center" style="padding: 30px 15px 30px 15px;">
                                                                                <i class="fa fa-thumbs-down fa-2x text-warning"></i><br>
                                                                                This product has no reviews.<br>
                                                                                Let others know what do you think and be the first to write a review.
                                                                            </p>
                                                                        </div>
                                                                    @endforelse

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End .collateral-box -->

                                    @php
                                    if (Request::is('customer/product/feedback*')) {
                                    $order_details = \App\Models\Admin\OrderDetail::where('order_id', $ord_id)->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->where('product_id', $single_product->id)->first();
                                    @endphp
                                    @if ($order_details->review == 0)
                                        <div class="add-product-review">
                                            <h3 class="text-uppercase heading-text-color font-weight-semibold">WRITE YOUR OWN REVIEW</h3>
                                            <p>How do you rate this product? *</p>

                                            <form action="{{ route('product.review', [$single_product->id, $ord_id]) }}" method="post">
                                                @csrf
                                                <table class="ratings-table">
                                                    <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th>1 star</th>
                                                        <th>2 stars</th>
                                                        <th>3 stars</th>
                                                        <th>4 stars</th>
                                                        <th>5 stars</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>Quality</td>
                                                        <td>
                                                            <input type="radio" name="ratings" id="Quality_1" value="1" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="ratings" id="Quality_2" value="2" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="ratings" id="Quality_3" value="3" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="ratings" id="Quality_4" value="4" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="ratings" id="Quality_5" value="5" class="radio" required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Value</td>
                                                        <td>
                                                            <input type="radio" name="value" id="Value_1" value="1" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="value" id="Value_2" value="2" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="value" id="Value_3" value="3" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="value" id="Value_4" value="4" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="value" id="Value_5" value="5" class="radio" required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Price</td>
                                                        <td>
                                                            <input type="radio" name="price" id="Price_1" value="1" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="price" id="Price_2" value="2" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="price" id="Price_3" value="3" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="price" id="Price_4" value="4" class="radio">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="price" id="Price_5" value="5" class="radio" required>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                <div class="form-group mb-2">
                                                    <label>Review <span class="required">*</span></label>
                                                    <textarea cols="5" rows="6" class="form-control form-control" name="review" style="max-width: 100%;" required></textarea>
                                                </div><!-- End .form-group -->

                                                <input type="submit" class="btn btn-primary" value="Submit Review">
                                            </form>
                                        </div><!-- End .add-product-review -->
                                    @else
                                    @endif
                                    @php
                                    }
                                    @endphp
                                </div><!-- End .product-reviews-content -->
                            </div><!-- End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .product-single-tabs -->
                </div><!-- End .col-lg-9 -->

                <div class="sidebar-overlay"></div>
                <div class="sidebar-toggle"><i class="icon-sliders"></i></div>
                <aside class="sidebar-product col-lg-3 padding-left-lg mobile-sidebar">
                    <div class="sidebar-wrapper">
                        <div class="widget widget-brand">
                            <a href="#" class="@if(!$single_product->get_brand->brand_logo) btn btn-info btn-lg btn-block @else @endif">
                                @if ($single_product->get_brand->brand_logo)
                                    <img src="{{ asset($single_product->get_brand->brand_logo) }}" alt="{{ $single_product->get_brand->brand_name }}">
                                @else
                                    {{ $single_product->get_brand->brand_name }}
                                @endif
                            </a>
                        </div><!-- End .widget -->

                        <div class="widget widget-info">
                            <ul>
                                <li>
                                    <i class="icon-shipping"></i>
                                    <h4>FREE<br>SHIPPING</h4>
                                </li>
                                <li>
                                    <i class="icon-us-dollar"></i>
                                    <h4>100% MONEY<br>BACK GUARANTEE</h4>
                                </li>
                                <li>
                                    <i class="icon-online-support"></i>
                                    <h4>ONLINE<br>SUPPORT 24/7</h4>
                                </li>
                            </ul>
                        </div><!-- End .widget -->

                        <div class="widget widget-banner">
                            <div class="banner banner-image">
                                <a href="#">
                                    <img src="{{ asset('frontend/images/banners/banner-sidebar.jpg') }}" alt="Banner Desc">
                                </a>
                            </div><!-- End .banner -->
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
                    </div>
                </aside><!-- End .col-md-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="featured-section">
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
                    @foreach($main_featured as $val)
                    <div class="product-default">
                        <figure>
                            <a href="{{ route('single.product.view', [$val->slug, Str::random(150)]) }}">
                                <img src="{{ asset($val->featured_image ? $val->featured_image : ' ') }}">
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
                                    {{ Str::limit($val->product_name, 15) }}
                                </a>
                            </h2>
                            <div class="price-box">
                                @if ($single_product->discount_price)
                                    <span class="old-price">${{ $single_product->selling_price }}</span>
                                    <span class="product-price">${{ $single_product->discount_price }}</span>
                                @else
                                    <span class="product-price">${{ $single_product->selling_price }}</span>
                                @endif
                            </div><!-- End .price-box -->
                            <div class="product-action">
                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>ADD TO CART</button>
                                <a href="{{ route('quick.view') }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                            </div>
                        </div><!-- End .product-details -->
                    </div>
                    @endforeach
                </div>
            </div><!-- End .container -->
        </div><!-- End .featured-section -->
    </main><!-- End .main -->
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/review.css') }}">
@endsection
