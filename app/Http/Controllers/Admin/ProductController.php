<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\CheckImage;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('q');
        $products = Product::latest('id')->where('name', 'like', '%' . $search . '%')->paginate(4);
        $products->load('category');
        $products->append(['q' => $search]);
        return view('admins.products.index', compact(['products', 'search']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all('id', 'name');
        return view('admins.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $sizes = $request->sizes ? json_decode($request->sizes) : [];
        $data = $request->validated();
        $data['image'] = CheckImage::checkImage($request, 'admin/product');
        $product = Product::create($data);
        $sizeArray = [];
        foreach ($sizes as $size) {
            $sizeArray[] = ['size' => $size->size, 'quantity' => $size->quantity, 'product_id' => $product->id];
        }
        ProductDetail::insert($sizeArray);

        return to_route('products.index')->with(['success' => 'Thêm thành công']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all('id', 'name');
        return view('admins.products.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $sizes = $request->sizes ? json_decode($request->sizes) : [];
        $data = $request->validated();
        $data['image'] = $request->hasFile('image') ? CheckImage::checkImage($request, 'admin/product') : $product->image;
        if ($request->hasFile('image')) {
            Storage::delete('public/images/admin/product/' . $data['image']);
        }
        $product->update($data);
        $sizeArray = [];
        foreach ($sizes as $size) {
            $sizeArray[] = ['size' => $size->size, 'quantity' => $size->quantity, 'product_id' => $product->id];
        }

        $product->details()->delete();
        ProductDetail::insert($sizeArray);

        return to_route('products.index')->with(['success' => 'Cập nhật thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete($product->id);
        return to_route('products.index')->with(['error' => 'Đã xoá sản phẩm']);
    }
    public function product_deleted(Request $request)
    {
        $search = $request->get('q');
        $products = Product::latest('id')->onlyTrashed()->where('name', 'like', '%' . $search . '%')->paginate(5);
        $products->load('category');
        $products->append(['q' => $search]);
        return view('admins.products.sortDelete', compact(['products', 'search']));
    }
    public function restore(Request $request)
    {
        try {
            $productId = $request->id;
            $product = Product::withTrashed()->findOrFail($productId);

            if ($product->trashed()) {
                $product->restore();
                return redirect()->route('products.deleted')->with(['success' => 'Đã khôi phục sản phẩm']);
            } else {
                return redirect()->route('products.deleted')->with(['error' => 'Không tìm thấy bản ghi đã xóa mềm']);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('products.deleted')->with(['error' => 'Không tìm thấy sản phẩm']);
        }
    }

    public function deleted(Request $request)
    {
        $product = Product::withTrashed()->find($request->id);

        if ($product) {
            Storage::delete('public/images/admin/product/' . $product->image);
            $product->forceDelete();
            return redirect()->route('products.deleted')->with(['success' => 'Đã xoá sản phẩm']);
        } else {
            return redirect()->route('products.deleted')->with(['error' => 'Không tìm thấy sản phẩm']);
        }
    }
}
