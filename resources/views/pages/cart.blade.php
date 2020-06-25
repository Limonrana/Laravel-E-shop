@extends('layouts.app')

@section('title', 'E-SHOP - Shopping Cart')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-table-container">
                        <table class="table table-cart">
                            <thead>
                            @if (count($cart) != 0)
                                <tr>
                                    <th class="product-col">Product</th>
                                    <th class="price-col">Price</th>
                                    <th class="qty-col">Qty</th>
                                    <th class="price-col">Action</th>
                                    <th>Subtotal</th>
                                </tr>
                            @else
                            @endif
                            </thead>
                            <tbody>
                            @forelse($cart as $val)
                            <tr class="product-row">
                                <td class="product-col">
                                    <figure class="product-image-container" style="max-width: 100px;">
                                        <a href="{{ route('single.product.view', [$val->options->slug, Str::random(150)]) }}" target="_blank" class="product-image">
                                            <img src="{{ asset($val->options->image) }}" width="100px" alt="product">
                                        </a>
                                    </figure>
                                    <h2 class="product-title">
                                        <a href="{{ route('single.product.view', [$val->options->slug, Str::random(150)]) }}" target="_blank">
                                            {{ Str::limit($val->name, 85) }}
                                        </a>
                                    </h2>
                                </td>
                                <td>${{ $val->price }}</td>
                                <form action="{{ route('cart.update', $val->rowId) }}" method="post">
                                    @csrf
                                <td>
                                    <div class="product-single-qty">
                                    <input class="form-control" name="qty" value="{{ $val->qty }}" type="number"/>
                                    </div>
                                </td>
                                <td>
                                    <button type="submit" style="border: none; background: transparent; text-decoration: underline; cursor: pointer;">
                                        Update
                                    </button>
                                </td>
                                </form>
                                <td>${{ $val->price * $val->qty }}</td>
                            </tr>
                            @php
                                $wishlist_check = \App\Models\Frontend\Wishlist::where('user_id', \Illuminate\Support\Facades\Auth::id())
                                                ->where('product_id', $val->id)->first();
                            @endphp
                            <tr class="product-action-row">
                                <td colspan="5" class="clearfix">
                                    <div class="float-left">
                                        @if($wishlist_check)
                                            <a class="btn-move wishlist" style="cursor: pointer; text-decoration: underline;" data-id="{{ $val->id }}">Already to Wishlist</a>
                                        @else
                                            <a class="btn-move wishlist" style="cursor: pointer; text-decoration: underline;" data-id="{{ $val->id }}">Move to Wishlist</a>
                                        @endif
                                    </div><!-- End .float-left -->

                                    <div class="float-right">
                                        <a href="{{ route('cart.remove', $val->rowId) }}" title="Remove product" class="btn-remove"><span class="sr-only">Remove</span></a>
                                    </div><!-- End .float-right -->
                                </td>
                            </tr>
                            @empty
                                <tr class="product-row">
                                    <td class="product-col" style="padding-top: 7%; padding-bottom: 7%;">
                                        <h2 class="text-center">Your cart is currently empty.</h2>
                                    </td>
                                </tr>
                            @endforelse

                            </tbody>

                            <tfoot>
                            <tr>
                                <td colspan="5" class="clearfix">
                                    <div class="float-left">
                                    </div><!-- End .float-left -->

                                    <div class="float-right">
                                        <a href="{{ route('shop.page') }}" class="btn btn-outline-secondary">Continue Shopping</a>
                                    </div><!-- End .float-right -->
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div><!-- End .cart-table-container -->

                    <div class="cart-discount">
                        <h4>Apply Discount Code</h4>
                        <form action="{{ route('apply.coupon') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="coupon_code" placeholder="Enter discount code">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="submit">Apply Discount</button>
                                </div>
                            </div><!-- End .input-group -->
                        </form>
                    </div><!-- End .cart-discount -->
                </div><!-- End .col-lg-8 -->

                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h3>Summary</h3>
                        <table class="table table-totals">
                            <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td>${{ Cart::Subtotal() }}</td>
                            </tr>

                            <tr>
                                <td>Tax</td>
                                <td>+ $0.00</td>
                            </tr>

                            @if (Session::has('coupon'))
                                <tr>
                                    <td><b>Discount Code</b> <span>({{ session()->get('coupon')['code'] }})</span></td>
                                    <td>
                                        <b>- ${{ session()->get('coupon')['discount'] }}</b>
                                        <br>
                                        <a href="{{ route('remove.coupon') }}" class="btn-move">Remove</a>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            @php
                                if (session()->has('coupon')) {
                                $discount_total = Cart::subtotal() - session()->get('coupon')['discount'];
                                }
                            @endphp
                            <tr>
                                <td>Order Total</td>
                                <td>${{ session()->has('coupon') ? $discount_total :  Cart::subtotal() }}</td>
                            </tr>
                            </tfoot>
                        </table>

                        <div class="checkout-methods">
                            <a href="{{ route('checkout.page') }}" class="btn btn-block btn-sm btn-primary">Go to Checkout</a>
                            <a href="{{ route('shop.page') }}" class="btn btn-link btn-block">Go To Shop</a>
                        </div><!-- End .checkout-methods -->
                    </div><!-- End .cart-summary -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-6"></div><!-- margin -->
    </main><!-- End .main -->
@endsection
