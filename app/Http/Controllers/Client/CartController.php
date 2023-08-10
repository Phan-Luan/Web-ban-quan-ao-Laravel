<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CartResource;
use App\Models\Bill;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    protected $cart;
    protected $product;
    protected $cartProduct;
    protected $coupon;
    protected $order;
    protected $user;
    protected $bill;

    public function __construct(Product $product, Cart $cart, CartProduct $cartProduct,  Order $order, Coupon $coupon, User $user, Bill $bill)
    {
        $this->product = $product;
        $this->cart = $cart;
        $this->cartProduct = $cartProduct;
        $this->coupon = $coupon;
        $this->order = $order;
        $this->user = $user;
        $this->bill = $bill;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = $this->cart->firtOrCreateBy(auth()->user()->id)->load('products');
        return view('clients.carts.index', compact('cart'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->product_size != null) {

            $product = $this->product->findOrFail($request->product_id);
            $cart = $this->cart->firtOrCreateBy(auth()->user()->id);
            $cartProduct = $this->cartProduct->getBy($cart->id, $product->id, $request->product_size);
            if ($cartProduct) {
                $quantity = $cartProduct->product_quantity;
                $cartProduct->update(['product_quantity' => ($quantity + $request->product_quantity)]);
            } else {
                $dataCreate['cart_id'] = $cart->id;
                $dataCreate['product_size'] = $request->product_size;
                $dataCreate['product_quantity'] = $request->product_quantity ?? 1;
                $dataCreate['product_price'] = $product->price;
                $dataCreate['product_id'] = $request->product_id;
                $this->cartProduct->create($dataCreate);
            }
            return back()->with(['message' => 'Thêm thành công']);
        } else {
            return back()->with(['message' => 'Bạn chưa chọn size']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function removeProductInCart($id)
    {
        $cartProduct =  $this->cartProduct->find($id);
        $cartProduct->delete();
        $cart =  $cartProduct->cart;
        return response()->json([
            'product_cart_id' => $id,
            'cart' => new CartResource($cart),
        ], Response::HTTP_OK);
    }



    public function updateQuantityProduct(Request $request, $id)
    {
        $cartProduct =  $this->cartProduct->find($id);
        $dataUpdate = $request->all();
        if ($dataUpdate['product_quantity'] < 1) {
            $cartProduct->delete();
        } else {
            $cartProduct->update($dataUpdate);
        }

        $cart =  $cartProduct->cart;


        return response()->json([
            'product_cart_id' => $id,
            'cart' => new CartResource($cart),
            'remove_product' => $dataUpdate['product_quantity'] < 1,
            'cart_product_price' => $cartProduct->total_price,
            'amount' => $dataUpdate,
        ], Response::HTTP_OK);
    }

    public function applyCoupon(Request $request)
    {
        $name = $request->input('coupon_code');
        $coupon = $this->coupon->firstWithExperyDate($name, auth()->user()->id);
        if ($coupon) {

            $message = 'Áp Mã giảm giá thành công !';
            $response = [
                'success' => true,
                'message' => $message,
                'coupon_id' => $coupon->id,
                'discount_amount_price' => $coupon->value,
                'coupon_code' => $coupon->name,
            ];
            Session::put('discount_amount_price', $coupon->value);
        } else {
            Session::forget(['discount_amount_price']);
            $message = 'Mã giảm giá không tồn tại hoặc hết hạn!';
            $response = [
                'success' => false,
                'message' => $message,
            ];
        }

        return response()->json($response);
    }

    public function checkout()
    {
        $cart = $this->cart->firtOrCreateBy(auth()->user()->id)->load('products');
        $user = $this->user->findOrFail(auth()->user()->id);
        $couponCode = Session::get('discount_amount_price');
        $cart['coupon_code'] = $couponCode;
        return view('clients.carts.checkout', compact('cart', 'user'));
    }

    public function processCheckout(Request $request)
    {
        $dataCreate = $request->all();
        $dataCreate['user_id'] = auth()->user()->id;
        $dataCreate['status'] = 'Pending';
        $order = $this->order->create($dataCreate);

        $cart = $this->cart->firtOrCreateBy(auth()->user()->id);
        $cartProducts = $cart->products;

        foreach ($cartProducts as $cartProduct) {
            $product = $this->product->with('details')->where('id', $cartProduct->product_id)->firstOrFail();

            //thay đổi số lượng sản phẩm của size khi mua 
            foreach ($product->details as $item) {
                if ($item->size == $cartProduct->product_size) {
                    $item->quantity  = $item->quantity - $cartProduct->product_quantity;
                    $item->save();
                }
            }
            $productOrderData = [
                'order_id' => $order->id,
                'product_id' => $cartProduct->product_id,
                'product_size' => $cartProduct->product_size,
                'product_quantity' => $cartProduct->product_quantity,
                'product_price' => $cartProduct->product_price,
            ];
            $this->bill->create($productOrderData);
        }

        $cartProducts->each->delete();
        $couponId = Session::get('coupon_id');
        $discount_amount_price = Session::get('discount_amount_price');
        if ($couponId) {
            $userId = auth()->user()->id;
            $existingCouponUser = CouponUser::where('coupon_id', $couponId)->where('user_id', $userId)->first();

            if (!$existingCouponUser) {
                $couponUser = new CouponUser();
                $couponUser->coupon_id = $couponId;
                $couponUser->user_id = $userId;
                $couponUser->value = $discount_amount_price;
                $couponUser->save();
            }
        }
        Session::forget(['coupon_id', 'discount_amount_price', 'coupon_code']);
        Artisan::call('test:send-mail-order', [
            'userId' => $order->user_id,
        ]);
        return to_route('confirmation');
    }
    public function myOrder(Request $request)
    {
        $orders = $this->order->where('user_id', $request->id)->paginate(4);
        if ($orders->isEmpty()) {
            return view('clients.profile.order', ['message' => 'Bạn chưa có đơn hàng nào']);
        }
        return view('clients.profile.order', compact('orders'));
    }
    public function processCheckoutVnpay(Request $request)
    {
        $data = $request->query();
        $dataCreate['user_id'] = auth()->user()->id;
        $dataCreate['status'] = 'Pending';
        $dataCreate['customer_name'] = $data['customer_name'];
        $dataCreate['customer_phone'] = $data['customer_phone'];
        $dataCreate['customer_email'] = $data['customer_email'];
        $dataCreate['customer_address'] = $data['customer_address'];
        $dataCreate['note'] = $data['note'];
        $dataCreate['ship'] = 20;
        $dataCreate['total'] = $data['total'];
        $dataCreate['payment'] = "VnPay";
        $order = $this->order->create($dataCreate);

        $cart = $this->cart->firtOrCreateBy(auth()->user()->id);
        $cartProducts = $cart->products;
        foreach ($cartProducts as $cartProduct) {
            $product = $this->product->with('details')->where('id', $cartProduct->product_id)->firstOrFail();
            //thay đổi số lượng sản phẩm của size khi mua 
            foreach ($product->details as $item) {
                if ($item->size == $cartProduct->product_size) {
                    $item->quantity  = $item->quantity - $cartProduct->product_quantity;
                    $item->save();
                }
            }
            $productOrderData = [
                'order_id' => $order->id,
                'product_id' => $cartProduct->product_id,
                'product_size' => $cartProduct->product_size,
                'product_quantity' => $cartProduct->product_quantity,
                'product_price' => $cartProduct->product_price,
            ];
            $this->bill->create($productOrderData);
        }

        $cartProducts->each->delete();
        Session::forget(['coupon_id', 'discount_amount_price', 'coupon_code']);
        Artisan::call('test:send-mail-order', [
            'userId' => $order->user_id,
        ]);
        return to_route('confirmation');
    }
}
