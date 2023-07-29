@extends('layouts.client')
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
                                    <input type="text" class="form-control" value="{{ old('customer_name')??$user->name}}"
                                        name="customer_name">
                                    @error('customer_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label>Mobile No</label>
                                    <input class="form-control" name="customer_phone" value="{{ old('customer_phone')??$user->phone }}"
                                        type="text" placeholder="+123 456 789">
                                    @error('customer_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="email_address">Email Address</label>
                                    <input type="email" class="form-control" name="customer_email"
                                        value="{{ old('customer_email')??$user->email }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label>Address </label>
                                    <input class="form-control" name="customer_address"
                                        value="{{ old('customer_address')??$user->address }}" type="text"
                                        placeholder="Thị xã, Thành phố">
                                    @error('customer_address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label>Note </label>
                                    <input class="form-control" value="{{ old('note') }}" name="note" type="text"
                                        placeholder="Note">
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
                                <input type="hidden" value="20" name="ship">
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
                total=total-(total/100*couponPrice)+shiping;
                $('.total-price-all').text(`$${total}`)
                $('#total').val(total)
            }

        });
    </script>
@endpush