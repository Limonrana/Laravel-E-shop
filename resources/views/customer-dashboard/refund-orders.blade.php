@extends('customer-dashboard.layout.app')
@section('title', 'E-SHOP - Customer Wishlist')
@section('content')
    <div class="col-md-12 pt-3">
        <div class="row">
            <div class="col-md-12 profile-tag-section text-center pr-4">
                <div class="row">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active">
                            <!--section content start-->
                            <div class="wishlist p-3">
                                <div class="headline-w text-left">
                                    <h4>All Wishlist</h4>
                                </div>
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
                                            <img src="{{ asset($val->get_product->featured_image) }}" width="120px" height="100px">
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
                                            <button class="btn bg-theme btn-sm single-add-cart" data-id="{{ $val->product_id }}">Add To Cart</button>
                                            <a href="{{ route('delete.wishlist', [$val->product_id, Str::random(150)]) }}" class="btn badge-danger btn-sm">Remove</a>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $wishlist->links() }}
                            </div>
                            <!--section content end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('single-page-js')
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
