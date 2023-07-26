@extends('layouts.admin')
@section('title','Category')
@section('name-content','Category')
@section('content')
<form  action="">
  <div class="input-group d-flex align-items-center my-2 justify-content-end">
    <div>Search:</div>
    <div class=""><input class="form-control mx-1" style="width: 200px" type="search" name="q" value="{{$search}}" id=""></div>
  </div>
</form>
  @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
  @endif
<table class="table table-bordered text-center">

  <thead>
    <th>#</th>
    <th>Name</th>
    <th>Image</th>
    <th>Description</th>
    <th>Action</th>
  </thead>
  <tbody>
    @php
      $index=1;
    @endphp
    @foreach ($categories as $item)
      <tr>
        <td>{{$index++}}</td>
        <td>{{$item->name}}</td>
        <td><img src="{{ asset('storage/images/admin/category/'.$item->image) }}" width="100" height="100" alt=""></td>
        <td>{{$item->desc}}</td>
        <td style="width: 200px">
          <form action="{{route('categories.destroy',$item)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Bạn muốn xoá danh mục này?')">Delete</button>
            <a href="{{route('categories.edit',$item)}}" class="btn btn-primary">Update</a>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<div class="d-flex justify-content-end">{{$categories->links()}}</div>
@endsection
