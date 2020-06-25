@extends('layouts.app')
@section('title', 'E-SHOP - Customer Wishlist')
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site_url') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Wishlist</li>
                </ol>
            </div><!-- End .container -->
        </nav>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 order-lg-last dashboard-content">
                            <h2>My Wishlist</h2>
                            <table class="table m-auto">
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($wishlist as $key=> $val)
                                        <tr>
                                        <th scope="row">{{ $wishlist->firstItem() + $key }}</th>
                                        <td>
                                            <img src="{{ asset($val->get_product->featured_image) }}" width="100px" height="80px">
                                        </td>
                                        <td class="text-left">
                                            <a href="{{ route('single.product.view', [$val->get_product->slug, Str::random(150)]) }}" target="_blank">
                                                {{ Str::limit($val->get_product->product_name, 50) }}
                                            </a>
                                            <div class="price">
                                                @if ($val->get_product->discount_price)
                                                    <span class="text-danger text-bold">${{ $val->get_product->discount_price }}</span>
                                                    <span><del> ${{ $val->get_product->selling_price }}</del></span>
                                                @else
                                                    <span>${{ $val->get_product->selling_price }}</span>
                                                @endif
                                            </div>
                                            <div class="category pt-1 text-bold text-info">
                                                {{ $val->get_product->get_category->category_name }}
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn bg-theme btn-sm single-add-cart mt-2" data-id="{{ $val->product_id }}">Add To Cart</button>
                                            <a href="{{ route('delete.wishlist', [$val->product_id, Str::random(150)]) }}" class="btn badge-danger btn-sm mt-2">Remove</a>
                                        </td>
                                    </tr>
                                    @empty
                                        <td colspan="20" style="padding-top: 7%; padding-bottom: 5%;">
                                            <h3 class="text-dark text-center">NO MORE WISHLIST HERE</h3>
                                            <div class="text-center pt-1">
                                                <a href="{{ route('shop.page') }}" class="btn btn-sm btn-info" >Order Now</a>
                                            </div>
                                        </td>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $wishlist->links() }}
                        </div><!-- End .col-lg-9 -->
                        @include('customer-dashboard/partials/sidebar')
                    </div><!-- End .row -->
                </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->
@endsection

@section('js')
    {{--    Single Cart Add--}}

    <script>
                $(document).ready(function () {
                    $('.single-add-cart').on('click', function () {
                        var id = $(this).data('id');
                        if (id) {
                            $.ajax({
                                url: '/product/single/add-to-cart/' + id,
                                type: "GET",
                                data_type: "json",
                                success: function (data) {
                                    console.log(data);
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 5000,
                                        timerProgressBar: true,
                                        onOpen: (toast) => {
                                            toast.addEventListener('mouseenter', Swal.stopTimer)
                                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                                        }
                                    })

                                    if ($.isEmptyObject(data.warning)) {
                                        Toast.fire({
                                            icon: 'success',
                                            title: data.success
                                        })
                                    } else {
                                        Toast.fire({
                                            icon: 'warning',
                                            title: data.warning
                                        })
                                    }
                                }
                            })
                        }
                    });
                });
    </script>
@endsection
