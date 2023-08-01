@extends('layouts.client')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">


            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
                Men
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Lightweight Jacket
            </span>
        </div>
    </div>

    @if (session('message'))
        <h2 class="text-success" style="text-align: center; width:100%;"> {{ session('message') }}</h2>
    @endif

    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>


                            <div class="slick3 gallery-lb">

                                <div class="item-slick3"
                                    data-thumb="{{ asset('storage/images/admin/product/' . $product->image) }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ asset('storage/images/admin/product/' . $product->image) }}"
                                            alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="{{ asset('storage/images/admin/product/' . $product->image) }}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <form action="{{ route('client.carts.add') }}" method="POST">
                            @csrf
                            <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                {{ $product->name }}
                            </h4>

                            <span class="mtext-106 cl2">
                                {{ $product->price }} $
                            </span>

                            <p class="stext-102 cl3 p-t-23">
                                {{ $product->description }}
                            </p>

                            <!--  -->
                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Size
                                    </div>
                                    @if ($product->details->count() > 0)
                                        <div class="size-204 respon6-next">
                                            <div class="rs1-select2 bor8 bg0">
                                                <select class="js-select2" name="product_size">
                                                    <option value="">Choose an option</option>
                                                    @foreach ($product->details as $size)
                                                        <option class="quantity_size" value="{{ $size->size }}">
                                                            {{ $size->size }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>
                                        </div>

                                </div>
                            @else
                                <p>Hết hàng</p>
                                @endif
                            </div>
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" type="number"
                                            name="product_quantity" value="1">


                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>
                                    <button
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                    </div>
                    </form>
                    <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                        <div class="flex-m bor9 p-r-10 m-r-11">
                            <a href="#"
                                class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                data-tooltip="Add to Wishlist">
                                <i class="zmdi zmdi-favorite"></i>
                            </a>
                        </div>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                            data-tooltip="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                            data-tooltip="Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>

                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                            data-tooltip="Google Plus">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#description" role="tab">Description</a>
                    </li>
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#reviews" role="tab">Reviews (1)</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-t-43">
                    <!-- - -->
                    <div class="tab-pane fade show" id="description" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <p class="stext-102 cl6">
                                Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit
                                amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus
                                interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et
                                elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu
                                velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec
                                iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat,
                                purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus
                                rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.
                            </p>
                        </div>
                    </div>

                    <!-- - -->
                    <div class="tab-pane fade show active" id="reviews" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                <div class="p-b-30 m-lr-15-sm">
                                    <!-- Review -->
                                    <div class="flex-w flex-t p-b-68">
                                        <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                            <img src="{{ asset('client/images/avatar-01.jpg') }}" alt="AVATAR">
                                        </div>

                                        <div class="size-207">
                                            <div class="flex-w flex-sb-m p-b-17">
                                                <span class="mtext-107 cl2 p-r-20">Ariana Grande</span>
                                            </div>

                                            <p class="stext-102 cl6">
                                                Quod autem in homine praestantissimum atque optimum est, id deseruit.
                                                Apud ceteros autem philosophos
                                            </p>
                                            @if (auth()->check())
                                                <p>
                                                    <a href="#" class="btn btn-sm btn-primary">Reply</a>
                                                </p>
                                            @endif

                                            <!-- Bình luận con-->
                                            <div class="">
                                                <div class="my-2">
                                                    <div class="flex-w flex-sb-m p-b-17">
                                                        <span class="mtext-107 cl2 p-r-20">
                                                            Ariana Grande
                                                        </span>
                                                    </div>

                                                    <p class="stext-102 cl6">
                                                        Quod autem in homine praestantissimum atque optimum est, id
                                                        deseruit.
                                                        Apud ceteros autem philosophos
                                                    </p>
                                                    @if (auth()->check())
                                                        <p>
                                                            <a href="#" class="btn btn-sm btn-primary">Reply</a>
                                                        </p>
                                                    @endif
                                                </div>
                                                <form style="display:none" action="" method="POST" class="w-full">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                    <div class="row p-b-25">
                                                        <div class="col-12 p-b-5">
                                                            <label class="stext-102 cl3" for="comment">Your
                                                                comment</label>
                                                            <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="content" name="content"></textarea>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-sm btn-primary">
                                                        Submit
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add review -->
                                    @if (auth()->check())
                                        <form action="" method="POST" class="w-full">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <h5 class="mtext-108 cl2 p-b-7">
                                                Add a comment
                                            </h5>

                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3" for="comment">Your comment</label>
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="content" name="content"></textarea>
                                                </div>
                                            </div>
                                            <button class="btn btn-sm btn-primary">Submit</button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">Đăng nhập để bình luận</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="stext-107 cl6 p-lr-25">
                SKU: JAK-01
            </span>

            <span class="stext-107 cl6 p-lr-25">
                Categories:

            </span>
        </div>
    </section>


    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Related Products
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">
                    @foreach ($relatedProducts as $item)
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="{{ asset('storage/images/admin/product/' . $item->image) }}"
                                        alt="IMG-PRODUCT">
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="{{ route('client.product.show', $item->id) }}"
                                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{ $item->name }}
                                        </a>

                                        <span class="stext-105 cl3">
                                            $ {{ $item->price }}
                                        </span>
                                    </div>

                                    <div class="block2-txt-child2 flex-r p-t-3">
                                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                            <img class="icon-heart1 dis-block trans-04"
                                                src="{{ asset('assets/clients/images/icons/icon-heart-01.png') }}"
                                                alt="ICON">
                                            <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                                src="{{ asset('assets/clients/images/icons/icon-heart-02.png') }}"
                                                alt="ICON">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Đăng nhập</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="error"></div>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" id="email" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" id="password" placeholder="Password" class="form-control">
                        </div>
                        <button type="button" class="btn btn-primary btn-block" id="btn-login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.btn-num-product-down').on('click', function() {
                var numProduct = Number($(this).next().val());
                if (numProduct > 0) $(this).next().val(numProduct - 1);
            });

            $('.btn-num-product-up').on('click', function() {
                var numProduct = Number($(this).prev().val());
                let maxValue = $(".num-product").attr("max")
                if (numProduct < maxValue) {
                    $(this).prev().val(numProduct + 1);
                }
            });
            $('.js-select2').change(function() {
                let select_value = $(".js-select2").val();
                const product_id = $("#product_id").val();
                console.log(product_id)
                let url = `quantity-size/${product_id}/${select_value}`;
                let max = $(".num-product")
                $.post(url, res => {
                    max.attr('max', res[0]);
                });
            })
            $('#btn-login').click(function(e) {
                e.preventDefault();
                const _csrf = '{{ csrf_token() }}';
                let _loginUrl = '{{ route('ajax.login') }}';
                let email = $('#email').val();
                let password = $('#password').val();

                $.ajax({
                    url: _loginUrl,
                    type: 'POST',
                    data: {
                        email: email,
                        password: password,
                        _token: _csrf
                    },
                    success: function(res) {
                        // console.log(res)
                        if (res.error) {
                            let _html_error =
                                '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            for (let error of res.error) {
                                _html_error += /*html*/ `
                    <li>${error}</li>
                    `;
                            }
                            _html_error += '</div>';
                            $('#error').html(_html_error);
                        } else {
                            alert('Đăng nhập thành công');
                            location.reload();
                        }
                    }
                });
            })
        });
    </script>
@endsection
