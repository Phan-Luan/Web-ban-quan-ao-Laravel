@extends('layouts.client')
@section('title_page', 'CheckOut')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/clients/css/checkout.css') }}">
@endpush
@section('content')
    <div class="checkout_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="checkout_details_area mt-50 clearfix">
                        <div class="cart-page-heading mb-30">
                            <h5>Billing Address</h5>
                        </div>
                        <form method="POST" action="{{ route('client.checkout.proccess') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="Name">Name</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('customer_name') ?? $user->name }}" id="name"
                                        name="customer_name">
                                    @error('customer_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label>Mobile No</label>
                                    <input class="form-control" id="phone" name="customer_phone"
                                        value="{{ old('customer_phone') ?? $user->phone }}" type="text"
                                        placeholder="+123 456 789">
                                    @error('customer_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="email_address">Email Address</label>
                                    <input type="email" id="email" class="form-control" name="customer_email"
                                        value="{{ old('customer_email') ?? $user->email }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label>Address </label>
                                    <input id="address" class="form-control" name="customer_address"
                                        value="{{ old('customer_address') ?? $user->address }}" type="text"
                                        placeholder="Thị xã, Thành phố">
                                    @error('customer_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label>Note </label>
                                    <input id="note" class="form-control" value="{{ old('note') }}" name="note"
                                        type="text" placeholder="Note">
                                    @error('note')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror ()
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <div class="order-details-confirmation">
                        <div class="cart-page-heading">
                            <h5>Your Order</h5>
                            <p>The Details</p>
                        </div>
                        <ul class="order-details-form mb-4">
                            <li><span>Product</span> <span>Total</span></li>
                            @foreach ($cart->products as $item)
                                <li><span>{{ $item->product_quantity }} x {{ $item->product->name }}</span>
                                    <p style="{{ $item->product->sale ? 'text-decoration: line-through' : '' }}; ">
                                        ${{ $item->product->price }}
                                    </p>
                                    @if ($item->product->sale)
                                        <p>
                                            ${{ $item->product_quantity * $item->product->sale_price }}
                                        </p>
                                    @endif
                                </li>
                            @endforeach
                            <li><span>Subtotal</span>
                                <div class="total-price" data-price="{{ $cart->total_price }}">
                                    ${{ $cart->total_price }}</div>
                            </li>
                            @if (session('discount_amount_price'))
                                <li><span>Coupon</span>
                                    <div data-price="{{ session('discount_amount_price') }}" class="coupon-div">
                                        {{ session('discount_amount_price') }} %</div>
                                </li>
                            @endif
                            <li><span>Shipping</span>
                                <div class="shipping" data-price="20">$20</div>
                                <input type="hidden" value="20" id="ship" name="ship">
                            </li>
                            <li><span>Total</span>
                                <div class="total-price-all"></div>
                                <input type="hidden" id="total" value="" name="total">
                            </li>
                        </ul>
                        <div id="accordion" role="tablist" class="mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0 row">
                                        <input type="radio" checked value="monney" name="payment" class="mx-2">
                                        <a href="#">Payment</a>
                                    </h6>

                                </div>
                            </div>
                        </div>
                        <button class="btn essence-btn">Place Order</button>
                        </form>
                        <form action="{{ route('vnpay_payment') }}" method="post" id="vnpay-form">
                            @csrf
                            <input type="hidden" id="total1" value="" name="total">
                            <input type="hidden" id="name1" value="" name="customer_name">
                            <input type="hidden" id="phone1" value="" name="customer_phone">
                            <input type="hidden" id="address1" value="" name="customer_address">
                            <input type="hidden" id="email1" value="" name="customer_email">
                            <input type="hidden" id="note1" value="" name="note">
                            <input type="hidden" id="ship1" value="" name="ship">
                            <input type="hidden" name="vnp_TxnRef" id="vnp_TxnRef">
                            <button type="submit" class="btn btn-primary" name="redirect">VnPay</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {
            getTotalValue()

            function getTotalValue() {
                let total = $('.total-price').data('price')
                let couponPrice = $('.coupon-div')?.data('price') ?? 0;
                let shiping = $('.shipping').data('price')
                total = total - (total / 100 * couponPrice) + shiping;
                $('.total-price-all').text(`$${total}`)
                $('#total').val(total)
                $('#total1').val(total)
                $('#note1').val($('#note').val())
                $('#name1').val($('#name').val())
                $('#phone1').val($('#phone').val())
                $('#address1').val($('#address').val())
                $('#email1').val($('#email').val())
                $('#ship1').val($('#ship').val())
            }
            $("#note,#name,#phone,#address,#email").on("change", () => {
                $('#note1').val($('#note').val())
                $('#name1').val($('#name').val())
                $('#phone1').val($('#phone').val())
                $('#address1').val($('#address').val())
                $('#email1').val($('#email').val())
            })

        });
    </script>
    <script>
        // Lấy giá trị ngày tháng năm giờ phút giây hiện tại
        var currentDate = new Date();
        var year = currentDate.getFullYear().toString();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        var day = currentDate.getDate().toString().padStart(2, '0');
        var hour = currentDate.getHours().toString().padStart(2, '0');
        var minute = currentDate.getMinutes().toString().padStart(2, '0');
        var second = currentDate.getSeconds().toString().padStart(2, '0');

        var randomString = Math.random().toString(36).substr(2, 5); 

        var transactionID = year + month + day + hour + minute + second + randomString;
        $("#vnp_TxnRef").val(transactionID);
    </script>
@endpush
