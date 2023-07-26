@extends('layouts.admin')

@section('title','Update Category')
@section('name-content',' Update Category')
@section('content')
  <form action="{{route('categories.update',$category)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <h2 class="text-center">Cập nhật danh mục</h2>
    <div class="form-group">
      <label for="" class="form-label">Tên danh mục</label>
      <input class="form-control" type="text" name="name" value="{{old('name')??$category->name}}">
    </div>
    <div class="form-group">
      <label for="" class="form-label">Ảnh</label>
      <img src="{{ asset('storage/images/admin/category/'.$category->image) }}" class="form-control" style="width: 200px; height: auto;" alt="">
      <input class="form-control mt-1" type="file" name="image">
    </div>
    <div class="form-group">
      <label for="" class="form-label">Mô tả</label>
      <input class="form-control" type="text" name="desc" value="{{old('desc')??$category->desc}}">
    </div>
    <button type="submit" class="btn btn-primary mt-2">Update</button>
  </form>
@endsection
