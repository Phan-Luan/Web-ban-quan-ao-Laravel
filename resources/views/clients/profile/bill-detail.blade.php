@extends('layouts.client')
@section('title_page', 'Chi tiết đơn hàng')
@section('content')
    <style>
        .container {
            margin-bottom: 100px;
        }
    </style>
    <div class="col-lg-12 grid-margin stretch-card container">

        <div class="card">
            <div class="card-body">
                <a href="{{ route('client.order', auth()->user()->id) }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
                <h4 class="card-title">Detail Bill</h4>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center" colspan="2">Product</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($bills as $item)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td><img src="{{ asset('storage/images/admin/product/' . $item->product->image) }}"
                                            width="100" alt=""></td>
                                    <td>{{ $item->product_quantity }}</td>
                                    <td>{{ $item->product_price }}</td>
                                    <td>{{ $item->product_price * $item->product_quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="btn-group mt-1" role="group" aria-label="Basic example">
                        {{ $bills->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
