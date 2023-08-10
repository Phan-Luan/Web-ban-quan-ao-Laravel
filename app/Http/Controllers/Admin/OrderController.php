<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Http\Response;
use PDF;

class OrderController extends Controller
{
    protected $order;
    protected $bill;

    public function __construct(Order $order, Bill $bill)
    {
        $this->order = $order;
        $this->bill = $bill;
    }

    public function index(Request $request)
    {
        $search = $request->get('q');
        $orders = Order::where('status', 'like', '%' . $search . '%')
            ->where('user_id', auth()->user()->id)
            ->paginate(10);

        return view('admins.bills.index', compact('orders', 'search'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order =  $this->order->findOrFail($id);
        $order->update(['status' => $request->status]);
        return  response()->json([
            'message' => 'success'
        ], Response::HTTP_OK);
    }

    public function bill_detail($id)
    {
        $bills = $this->bill->with(['order', 'product'])->where('order_id', $id)->paginate(5);
        $id_bill = $id;
        return view('admins.bills.detail', compact('bills', 'id_bill'));
    }
    public function print_bill($checkout_code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code)
    {
        $order_detail = $this->order->findOrFail($checkout_code);
        $bill_details = $this->bill->with(['product', 'order'])->where('order_id', $checkout_code)->get();
        $date = date('d-m-Y');
        $output = <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <html>
        <head>
            <meta charset="utf-8">
            <title>Xuất hoá đơn - $checkout_code</title>
            <!-- Thêm các liên kết tới các tệp CSS của Bootstrap -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <style>
            body{
                font-family: 'Dejavu Sans', sans-serif;
            }
            thead tr th,tbody tr td{
                text-align: center;
            }
            .title_bill{
                font-size:30px;
                border-bottom: 1px solid #000;
                padding-bottom:5px;
            }
            ul li{
                list-style:none;
            }
            .hr{
                border-bottom:1px solid #000;
                padding-bottom:10px;
            }
        </style>
        <body>
            <div class="container-fluid">
                <div class="row mb-1">
                    <div class="mb-1"><img src="assets/clients/images/icons/logo-01.png"/></div>
                    <div class="">
                        <p class="float-right">Ngày: {$date}</p>
                        <p>Ký hiệu: COZASTORE-{$checkout_code}</p>
                    </div>
                </div>
                <p class="text-center mb-2 title_bill">
                    Hoá đơn bán hàng
                </p>
                <ul class="list-group hr">
                    <li class="">Tên cửa hàng: Cửa hàng Coza Store</li>
                    <li class="">Phone: 0968768464</li>
                    <li class="">Địa chỉ: Tây Mỗ, Nam Từ Liêm, Hà Nội</li>
                </ul>
                <ul class="list-group">
                    <li class="">Tên khách hàng: {$order_detail->customer_name}</li>
                    <li class="">Email: {$order_detail->customer_email}</li>
                    <li class="">Phone: {$order_detail->customer_phone}</li>
                    <li class="">Địa chỉ: {$order_detail->customer_address}</li>
                    <li>Phương thức thanh toán: {$order_detail->payment}</li>
                </ul>
                <div class="table-responsive">
                    <table class="table table-primary table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Size</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
        HTML;
        $index = 0;
        foreach ($bill_details as $item) {
            $index++;
            $output .= <<<HTML
                        <tr>
                            <td>{$index}</td>
                            <td>{$item->product->name}</td>
                            <td><img src="storage/images/admin/product/{$item->product->image}" width="100"></td>
                            <td>{$item->product_size}</td>
                            <td>{$item->product_quantity}</td>
                            <td>{$item->product->price}</td>
                        </tr>
        HTML;
        }
        $output .= <<<HTML
                        <tr>
                            <td>Transport fee</td>
                            <td>$order_detail->ship</td>
                            <td colspan="3">Total</td>
                            <td>$order_detail->total</td>
                        </tr>
                        </tbody>
                    </table>
                    <ul>
                    <li class=""><span style="color:red;">*</span> Ghi chú: {$order_detail->note}</li>
                    </ul>
                </div>
            </div>
            
            <!-- Thêm các liên kết tới các tệp JavaScript của Bootstrap -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>
        HTML;
        return $output;
    }
}
