<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\CheckImage;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('q');
        $categories = Category::latest('id')->where('name', 'like', '%' . $search . '%')->paginate(5);
        $categories->appends(['q' => $search]);
        return view('admins.categories.index', ['categories' => $categories, 'search' => $search]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $data['image'] = CheckImage::checkImage($request,'admin/category');

        Category::create($data);

        return to_route('categories.index')->with(['success' => 'Thêm thành công']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admins.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $data['image'] = $request->hasFile('image') ? CheckImage::checkImage($request,'admin/category') : $category->image;

        $category->update($data);

        return redirect()->route('categories.index')->with(['success' => 'Cập nhật thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->destroy($category->id); //xoá mềm
        // $category->forceDelete(); //xoá cứng
        return to_route('categories.index');
    }
}
