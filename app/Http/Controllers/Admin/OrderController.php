<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Http\Response;

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
        $bills = $this->bill->with(['order','product'])->where('order_id', $id)->paginate(5);
        return view('admins.bills.detail', compact('bills'));
    }
}
