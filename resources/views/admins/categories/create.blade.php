@extends('layouts.admin')
@section('title','Create Category')
@section('name-content','Create Category')
@section('content')
  <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <h2 class="text-center">Thêm danh mục</h2>
    <div class="form-group">
      <label for="" class="form-label">Tên danh mục</label>
      <span class="text-danger m-1">
        @error('name')
          {{$message}}
        @enderror
      </span>
      <input class="form-control" type="text" name="name" value="{{old('name')}}">
    </div>
    <div class="form-group">
      <label for="" class="form-label">Ảnh</label>
      <span class="text-danger m-1">
        @error('image')
          {{$message}}
        @enderror
      </span>
      <input class="form-control" type="file" name="image" value="{{old('image')}}">
    </div>
    <div class="form-group">
      <label for="" class="form-label">Mô tả</label>
      <span class="text-danger m-1">
        @error('desc')
          {{$message}}
        @enderror
      </span>
      <input class="form-control" type="text" name="desc" value="{{old('desc')}}">
    </div>
    <button type="submit" class="btn btn-primary mt-2">Thêm</button>
  </form>
@endsection