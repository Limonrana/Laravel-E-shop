<body>
@php
$header = \App\Models\Admin\HeaderFooter::where('id', 1)->first();
@endphp
<div class="page-wrapper">
    <header class="header">
        <div class="header-top">
            <div class="container">
                <div class="header-left header-dropdowns">
                    <p class="welcome-msg">{{ $header->top_massage }}</p>
{{--                    <div class="header-dropdown">--}}
{{--                        <a href="#">USD</a>--}}
{{--                        <div class="header-menu">--}}
{{--                            <ul>--}}
{{--                                <li><a href="#">EUR</a></li>--}}
{{--                                <li><a href="#">USD</a></li>--}}
{{--                            </ul>--}}
{{--                        </div><!-- End .header-menu -->--}}
{{--                    </div><!-- End .header-dropown -->--}}

{{--                    <div class="header-dropdown">--}}
{{--                        <a href="#"><img src="{{ asset('frontend/images/flags/en.png') }}" alt="England flag">ENGLISH</a>--}}
{{--                        <div class="header-menu">--}}
{{--                            <ul>--}}
{{--                                <li><a href="#"><img src="{{ asset('frontend/images/flags/en.png') }}" alt="England flag">ENGLISH</a></li>--}}
{{--                                <li><a href="#"><img src="{{ asset('frontend/images/flags/fr.png') }}" alt="France flag">FRENCH</a></li>--}}
{{--                            </ul>--}}
{{--                        </div><!-- End .header-menu -->--}}
{{--                    </div><!-- End .header-dropown -->--}}

{{--                    <div class="dropdown compare-dropdown">--}}
{{--                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">--}}
{{--                            <i class="icon-retweet"></i> Compare (2)--}}
{{--                        </a>--}}

{{--                        <div class="dropdown-menu" >--}}
{{--                            <div class="dropdownmenu-wrapper">--}}
{{--                                <ul class="compare-products">--}}
{{--                                    <li class="product">--}}
{{--                                        <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>--}}
{{--                                        <h4 class="product-title"><a href="#">Lady White Top</a></h4>--}}
{{--                                    </li>--}}
{{--                                    <li class="product">--}}
{{--                                        <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>--}}
{{--                                        <h4 class="product-title"><a href="#">Blue Women Shirt</a></h4>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}

{{--                                <div class="compare-actions">--}}
{{--                                    <a href="#" class="action-link">Clear All</a>--}}
{{--                                    <a href="#" class="btn btn-primary">Compare</a>--}}
{{--                                </div>--}}
{{--                            </div><!-- End .dropdownmenu-wrapper -->--}}
{{--                        </div><!-- End .dropdown-menu -->--}}
{{--                    </div><!-- End .dropdown -->--}}
                </div><!-- End .header-left -->

                <div class="header-right">
                    <div class="header-dropdown dropdown-expanded">
                        <a href="#">Links</a>
                        <div class="header-menu">
                            <ul>
                                <li><a href="#" data-toggle="modal" data-target="#exampleModal">TRACKING ORDER</a></li>
                                <li><a href="{{ route('blog.page') }}">BLOG</a></li>
                                <li><a href="{{ route('contact.page') }}">Contact</a></li>
                                @if (Route::has('login'))
                                    @auth
                                        <li><a href="{{ route('customer.wishlist') }}">MY WISHLIST </a></li>
                                        <li><a href="{{ route('customer.account') }}">MY ACCOUNT </a></li>
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                        </li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @else
{{--                                        class="login-link"--}}
                                        <li><a href="{{ route('login') }}">LOG IN </a></li>
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                    @endauth
                                @endif
                            </ul>
                        </div><!-- End .header-menu -->
                    </div><!-- End .header-dropown -->
                </div><!-- End .header-right -->
            </div><!-- End .container -->
        </div><!-- End .header-top -->

        <div class="header-middle">
            <div class="container">
                <div class="header-left">
                    <a href="{{ route('site_url') }}" class="logo">
                        @if ( $header->logo)
                            <img src="{{ asset($header->logo) }}" width="{{ $header->logo_width }}" alt="Porto Logo">
                        @else
                            <h3 class="text-white" style="font-size: 30px; text-decoration: none;">E-SHOP STORE</h3>
                        @endif
                    </a>
                </div><!-- End .header-left -->

                @php
                    $category = \App\Models\Admin\Category::orderBy('category_name', 'asc')->get();
                @endphp

                <div class="header-center">
                    <div class="header-search">
                        <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                        <form action="{{ route('product.search') }}" method="get">
                            <div class="header-search-wrapper">
                                <input type="search" class="form-control" name="search" id="q" placeholder="Search..." required>
                                <div class="select-custom">
                                    <select id="cat" name="category">
                                        <option value="">All Categories</option>
                                        @foreach($category as $val)
                                        <option value="{{ $val->id }}">{{ $val->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div><!-- End .select-custom -->
                                <button class="btn" type="submit"><i class="icon-magnifier"></i></button>
                            </div><!-- End .header-search-wrapper -->
                        </form>
                    </div><!-- End .header-search -->
                </div><!-- End .headeer-center -->

                <div class="header-right">
                    <button class="mobile-menu-toggler" type="button">
                        <i class="icon-menu"></i>
                    </button>
                    <div class="header-contact">
                        <span>{{ $header->phone_subtitle }}</span>
                        <a href="tel:{{ $header->phone_number }}"><strong>{{ $header->phone_number }}</strong></a>
                    </div><!-- End .header-contact -->

                    <div class="dropdown cart-dropdown">
                        <a href="{{ route('cart.page') }}" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                            <span class="cart-count">{{ Cart::Count() }}</span>
                        </a>

                        <div class="dropdown-menu" >
                            <div class="dropdownmenu-wrapper">
                                <div class="dropdown-cart-header">
                                    <span>{{ Cart::Count() }} Items</span>

                                    <a href="{{ route('cart.page') }}">View Cart</a>
                                </div><!-- End .dropdown-cart-header -->
                                <div class="dropdown-cart-products">
                                    @foreach(Cart::Content() as $val)
                                    <div class="product">
                                        <div class="product-details">
                                            <h4 class="product-title">
                                                <a>{{ Str::limit($val->name, 15) }}</a>
                                            </h4>

                                            <span class="cart-product-info">
                                                    <span class="cart-product-qty">{{ $val->qty }}</span>
                                                    x ${{ $val->price }}
                                                </span>
                                        </div><!-- End .product-details -->

                                        <figure class="product-image-container">
                                            <a class="product-image">
                                                <img src="{{ asset($val->options->image) }}" alt="{{ $val->name }}">
                                            </a>
                                            <a href="{{ route('cart.remove', $val->rowId) }}" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                                        </figure>
                                    </div><!-- End .product -->
                                    @endforeach
                                </div><!-- End .cart-product -->

                                <div class="dropdown-cart-total">
                                    <span>Total</span>

                                    <span class="cart-total-price">${{ Cart::subtotal() }}</span>
                                </div><!-- End .dropdown-cart-total -->

                                <div class="dropdown-cart-action">
                                    <a href="{{ route('checkout.page') }}" class="btn btn-block">Checkout</a>
                                </div><!-- End .dropdown-cart-total -->
                            </div><!-- End .dropdownmenu-wrapper -->
                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .dropdown -->
                </div><!-- End .header-right -->
            </div><!-- End .container -->
        </div><!-- End .header-middle -->

        <div class="header-bottom sticky-header">
            <div class="container">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('site_url') }}">Home</a></li>
                        <li class="{{ Request::is('shop') ? 'active' : '' }}"><a href="{{ route('shop.page') }}">Shop</a></li>
                        <li class="megamenu-container">
                            <a href="product.html" class="sf-with-ul">Featured</a>
                            <div class="megamenu">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            @php
                                            $category = \App\Models\Admin\Category::take(4)->get();
                                            @endphp
                                            @foreach($category as $val)
                                                @php
                                                $product = \App\Models\Admin\Product::where('category_id', $val->id)->count();
                                                $subcategory = \App\Models\Admin\Subcategory::where('category_id', $val->id)->take(5)->get();
                                                @endphp
                                            <div class="col-lg-3">
                                                <div class="menu-title">
                                                    @if ($product <=> 3)
                                                        <a href="{{ route('category.taxonomy', [Str::of($val->category_name)->slug('-'), $val->id]) }}">
                                                            {{ $val->category_name }}
                                                        </a>
                                                    @endif
                                                </div>
                                                <ul>
                                                    @foreach($subcategory as $sub)
                                                    <li><a href="{{ route('subcategory.taxonomy', [Str::of($sub->subcategory_name)->slug('-'), $sub->id]) }}">
                                                            {{ $sub->subcategory_name }}
                                                        </a></li>
                                                    @endforeach
                                                </ul>
                                            </div><!-- End .col-lg-4 -->
                                            @endforeach
                                        </div><!-- End .row -->
                                    </div><!-- End .col-lg-8 -->
                                    <div class="col-lg-3">
                                        <div class="banner">
                                            <a href="{{ route('shop.page') }}">
                                                <img src="{{ asset($header->menu_image) }}" alt="Menu banner" class="product-promo">
                                            </a>
                                        </div><!-- End .banner -->
                                    </div><!-- End .col-lg-4 -->
                                </div><!-- End .row -->
                            </div><!-- End .megamenu -->
                        </li>
                        <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="{{ route('about.page') }}">About Us</a></li>
                        <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="{{ route('contact.page') }}">Contact Us</a></li>
                        <li class="{{ Request::is('blog') ? 'active' : '' }}"><a href="{{ route('blog.page') }}">Blog</a></li>
                        <li class="float-right"><a href="{{ route('order.confirm.page') }}">Special Offer!</a></li>
                    </ul>
                </nav>
            </div><!-- End .header-bottom -->
        </div><!-- End .header-bottom -->
    </header><!-- End .header -->
