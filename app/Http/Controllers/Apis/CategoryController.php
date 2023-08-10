<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $search = $req->query('q');
        $categories = Category::latest('id')->where('name', 'like', '%' . $search . '%')->get();
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = [
            "name" => $request->input('name'),
            "desc" => $request->input('desc'),
            "image" => $request->file('image')->getClientOriginalName(),
        ];
        $category = Category::create($data);
        return response()->json($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if ($request->hasFile('image')) {
            Storage::delete('public/images/admin/product/' . $request->file('image'));
        }
        $data = [
            "name" => $request->input('name'),
            "desc" => $request->input('desc'),
            "image" => $request->hasFile('image') ? $request->file('image')->getClientOriginalName() : $category->image
        ];

        $category->update($data);
        return response()->json($category);
    }

    /**
     * Remove the specified resource -from storage.
     */
    public function destroy(Category $category)
    {
        Storage::delete('public/images/admin/product/' . $category->image);
        $category = $category->destroy($category->id); //xoá mềm
        // $category->forceDelete(); //xoá cứng
        return response()->json(['message' => "Đã xoá category", $category, $category]);
    }
}
