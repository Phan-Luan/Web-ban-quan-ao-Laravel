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

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('q');
        $products = Product::latest('id')->where('name', 'like', '%' . $search . '%')->paginate(5);
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
        return to_route('products.index')->with(['success' => 'Đã xoá sản phẩm']);
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show($id)
    // {
    //     $product = $this->product->with(['details', 'category'])->findOrFail($id);
    //     $product->description = htmlspecialchars_decode($product->description);

    //     return view('admin.product.show', compact('product'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     $product = $this->product->with(['details', 'category'])->findOrFail($id);

    //     $categories = $this->category->get(['id', 'name']);
    //     return view('admin.product.edit', compact('categories','product'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     $dataUpdate = $request->except('sizes');
    //     $sizes = $request->sizes ? json_decode($request->sizes) : [];
    //     return dd($sizes);
    //     // $product = $this->product->findOrFail($id);
    //     // if ($request->file('image') !== null) {
    //     //     $dataUpdate['image'] = $request->file('image')->getClientOriginalName(); //lay ten file
    //     //     $request->file('image')->storeAs('public/images',   $dataUpdate['image']); //luu file vao duong dan public/images voi ten $image
    //     // }

    //     // $product->update( $dataUpdate); //tao ban ghi co du lieu la $data

    //     // $sizeArray = [];
    //     // foreach ($sizes as $size) {
    //     //     $sizeArray[] = ['size' => $size->size, 'quantity' => $size->quantity, 'product_id' => $product->id];
    //     // }
    //     // $product->details()->delete();
    //     // $this->productDetail->insert($sizeArray);
    //     // return redirect()->route('products.index')->with(['message' => 'Update product success']);
    // }
}
