<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    protected $category;
    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->latest('id')->paginate(8);
        $categories = $this->category->all();
        return view('clients.products', compact('products', 'categories'));
    }
    public function category_product(Request $request, $category_id)
    {
        $products = $this->product->getBy($request->all(), $category_id);
        $categories = $this->category->all();
        return view('clients.products', compact('products', 'categories'));
    }
    public function show($id)
    {
        $product = $this->product->with('details')->findOrFail($id);
        // dd($product);
        $categoryId = $product->category->pluck('id')->first();

        $relatedProducts = $this->product->getBy($product->name, $categoryId);

        return view('clients.product.product-detail', compact('product', 'relatedProducts'));
    }
    public function quantity_size(Request $request)
    {
        $product_id = $request->id;
        $size = $request->size;

        $product = $this->product->where('id', $product_id)->first();

        if ($product) {
            $details = $product->details->where('size', $size)->first();

            if ($details) {
                $quantity = $details->quantity;
                return response()->json([$quantity]);
            }
        }
        return response()->json(['error' => "Không tìm thấy sản phẩm"], 404);
    }
}
