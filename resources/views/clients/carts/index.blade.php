@extends('layouts.client')
@section('content')
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Shoping Cart
            </span>
        </div>
    </div>


    <!-- Shoping Cart -->
    <div id="message">

    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart text-center">
                            <tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-5">Size</th>
                                <th class="column-6">Quantity</th>
                                <th class="column-7">Total</th>
                                <th class="column-8">Cancel</th>
                            </tr>
                            @foreach ($cart->products as $item)
                                <tr class="table_row" id="row-{{ $item->id }}">
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <img src="{{ asset('storage/images/admin/product/' . $item->product->image) }}"
                                                alt="IMG">
                                        </div>
                                    </td>
                                    <td class="column-2">{{ $item->product->name }}</td>
                                    <td class="column-3">
                                        <p style="{{ $item->product->sale ? 'text-decoration: line-through' : '' }}; ">
                                            ${{ $item->product->price }}
                                        </p>
                                        @if ($item->product->sale)
                                            <p> ${{ $item->product->sale_price }} </p>
                                        @endif
                                    </td>

                                    <td class="column-5 size product-size">{{ $item->product_size }}</td>

                                    <td class="column-6">
                                        <input type="hidden" id="product_id" value="{{ $item->product_id }}">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <button
                                                class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m btn-update-quantity"
                                                data-action="{{ route('client.carts.update_product_quantity', $item->id) }}"
                                                data-id="{{ $item->id }}">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </button>

                                            <input
                                                class="mtext-104 cl3 txt-center product-quantity-input num-product num-product-{{ $item->product_size }}"
                                                type="number" id="productQuantityInput-{{ $item->id }}"
                                                value="{{ $item->product_quantity }}" max="">

                                            <button
                                                class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m btn-update-quantity"
                                                data-action="{{ route('client.carts.update_product_quantity', $item->id) }}"
                                                data-id="{{ $item->id }}">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </button>
                                        </div>
                                    </td>

                                    <td class="column-7" id="price-{{ $item->id }}">
                                        ${{ $item->product->price * $item->product_quantity }}
                                    </td>

                                    <td class="column-8">
                                        <button class=" btn-remove-product"
                                            data-action="{{ route('client.carts.remove_product', $item->id) }}"><i
                                                class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">
                            <form method="POST" id="form-coupon" data-action="{{ route('client.carts.apply_coupon') }}">
                                @csrf
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                                    id="coupon_code" placeholder="Coupon Code" value="">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2 total-price" data-price="{{ $cart->total_price }}">
                                ${{ $cart->total_price }}
                            </span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2" id="value_coupon">

                    </div>



                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2 total-price-all">

                            </span>
                        </div>
                    </div>

                    <a href="{{ route('client.checkout.index') }}"
                        class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">

                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.btn-num-product-down').on('click', function() {
                var numProduct = Number($(this).next().val());
                if (numProduct > 1) $(this).next().val(numProduct - 1);
            });

            $('.btn-num-product-up').on('click', function() {
                var numProduct = Number($(this).prev().val());
                let maxValue = $(this).closest('.table_row').find('.product-quantity-input').attr('max');

                if (numProduct < maxValue) {
                    $(this).prev().val(numProduct + 1);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.product-size').each(function() {
                let index = 0;
                let select_value = $(this).text().trim();

                const product_id = $("#product_id").val();

                let url = `quantity-size/${product_id}/${select_value}`;

                $.post(url, res => {
                    $(this).closest('.table_row').find(`.num-product-${select_value}`).attr('max',
                        res[index++]);
                });
            });
        });
    </script>
@endsection

@push('script')
    <script>
        $(function() {
            getTotalValue();

            function getTotalValue() {
                let total = $('.total-price').data('price');
                let couponPrice = $('.coupon-div')?.data('price') ?? 0;
                $('.total-price-all').text(`$${total - (total/100*couponPrice)}`);
            }
            $('#form-coupon').on('submit', function(e) {
                e.preventDefault();
                let url = $(this).data('action');
                let data = {
                    coupon_code: $(`#coupon_code`).val(),
                }
                $.post(url, data, res => {
                    $('#value_coupon').html( /*html*/ `
                        <h6 class="font-weight-medium">Coupon </h6>
                        <h6 class="font-weight-medium coupon-div" data-price="${res.discount_amount_price??0}">${res.discount_amount_price??0} %</h6>
                    `);
                }).then(res => {
                    let total = $('.total-price').data('price');
                    let total_price = res.discount_amount_price ?? 0;
                    $('.total-price-all').text(
                        `$${total - (total/100*total_price)}`);
                    $('#message').html(
                        `<h2 class="my-3 text-success" style="text-align: center; width:100%;">${res.message}</h2>`
                    );
                })
                // console.log(url);
            })
            $(document).on('click', '.btn-remove-product', function(e) {
                let url = $(this).data('action');
                confirmDelete().then(function() {
                    $.post(url, res => {
                        // console.log(res);
                        let cart = res.cart;
                        let cartProductId = res.product_cart_id;
                        let coupon_code = $('.coupon-div')?.data('price') ?? 0;
                        $('#productCountCart').text(cart.product_count);
                        $('.total-price').text(`$${cart.total_price}`).data('price', cart
                            .product_count);
                        $(`#row-${cartProductId}`).remove();
                        $('.total-price-all').text(
                            `$${cart.total_price - (cart.total_price/100*coupon_code)}`
                        );
                    });
                }).catch(function() {});
            });

            const TIME_TO_UPDATE = 1500;
            $(document).on('click', '.btn-update-quantity', _.debounce(function(e) {
                let url = $(this).data('action');
                let id = $(this).data('id');
                let data = {
                    product_quantity: $(`#productQuantityInput-${id}`).val(),
                };

                $.post(url, data, res => {
                    // console.log(res);
                    let cartProductId = res.product_cart_id;
                    let cart = res.cart;
                    let coupon_code = $('.coupon-div')?.data('price') ?? 0;
                    $('#productCountCart').text(cart.product_count);
                    if (res.remove_product) {
                        $(`#row-${cartProductId}`).remove();
                    } else {
                        $(`#cartProductPrice${cartProductId}`).html(
                            `$${res.cart_product_price}`);
                    }

                    getTotalValue(); // Cập nhật tổng giá trị sau khi thay đổi số lượng
                    $('.total-price').text(`$${cart.total_price}`);
                    $(`#price-${res.product_cart_id}`).text(`${res.cart_product_price}`);
                    $('.total-price-all').text(
                        `$${cart.total_price - (cart.total_price/100*coupon_code)}`);
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "success",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                });
            }, TIME_TO_UPDATE));
        });
    </script>
@endpush
