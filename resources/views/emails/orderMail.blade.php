<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="md-contents my-2">
    <strong>
        Xin chào, {{ $user->name }},
    </strong>
    <p>Dưới đây là chi tiết đơn hàng của bạn:</p>
    <div class="table-responsive pt-3">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th style="width: 50px">#</th>
                    <th colspan="2">Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 1;
                @endphp
                @foreach ($user->bills as $item)
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
                <tr>
                    <td colspan="1"><strong>Transport fee</strong></td>
                    <td colspan="1">{{ $user->order->ship }}</td>
                    <td colspan="2"><strong>Total Bill</strong></td>
                    <td colspan="2">{{ $user->order->total }}</td>
                </tr>
            </tbody>
        </table>
        <p>Cảm ơn quý khách đã mua hàng tại cửa hàng của chúng tôi.</p>
    </div>
