$(document).ready(function () {
    $('.wishlist').on('click', function () {
        var id = $(this).data('id');
        if (id) {
            $.ajax({
                url: '/product/wishlist/' + id,
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


// Single Cart Add

$(document).ready(function () {
    $('.btn-add-cart').on('click', function () {
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

// Quick View Ajax

function quickview(id) {
    $.ajax({
        url: '/product/single/quick/view/' + id,
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
};

// Model Add to Cart Ajax

    $('#model-cart').on('submit',function(event){
        event.preventDefault();

        product_id = $('#product_id').val();
        p_size = $('#p_size').val();
        p_color = $('#p_color').val();
        p_capacity = $('#p_capacity').val();
        qty = $('#qty').val();

        $.ajax({
            url: "/product/single/model/cart",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                product_id:product_id,
                p_size:p_size,
                p_color:p_color,
                p_capacity:p_capacity,
                qty:qty,
            },
            success:function(data){
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


            },
        });
    });


// Topbar Add Cart Item Delete

$(document).ready(function () {
    $('.fgdfhfdhdf').on('click', function () {
        var id = $(this).data('id');
        alert(id);
        if (id) {
            $.ajax({
                url         : '/topbar/cart/remove/' + id,
                type        : "GET",
                data_type   : "json",
                success     : function (data) {
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

$(document).on("click", "#delete", function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    swal({
        title: "Are you Want to delete?",
        text: "Once Delete, This will be Permanently Delete!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
                swal("Safe Data!");
            }
        });
});
