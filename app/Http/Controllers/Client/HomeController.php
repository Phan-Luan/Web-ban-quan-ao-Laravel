<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function index(Request $request)
    {
        $products = $this->product->with('category')->latest('id')->take(8)->get();

        return view('clients.home', compact('products'));
    }
}
