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
        $categoryId = $product->category->pluck('id')->first(); // Assuming a product can belong to multiple categories, we retrieve the first category ID.

        $relatedProducts = $this->product->getBy($product->name, $categoryId);

        return view('clients.product.product-detail', compact('product', 'relatedProducts'));
    }
}
