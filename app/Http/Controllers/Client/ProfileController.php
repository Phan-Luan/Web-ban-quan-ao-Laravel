<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    protected $user;
    protected $order;
    protected $bill;

    public function __construct(User $user, Order $order, Bill $bill)
    {
        $this->user = $user;
        $this->order = $order;
        $this->bill = $bill;
    }
    public function myProfile(Request $request)
    {
        $user = $this->user->findOrFail($request->id);
        return view('clients.profile.profile', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $dataUpdate = $request->except('password');
        $user = $this->user->findOrFail($request->id);
        $user->update($dataUpdate);
        return to_route('client.profile', $request->id)->with(['message' => 'update success']);
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
        return view('clients.profile.bill-detail', compact('bills'));
    }
}
