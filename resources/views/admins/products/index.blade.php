@extends('layouts.admin')
@section('name-content')
    List Product
@endsection
@section('title', 'List Product')
@section('content')
    <form action="">
        <div class="input-group d-flex align-items-center my-2 justify-content-end">
            <div>Search:</div>
            <div class=""><input class="form-control mx-1" style="width: 200px" type="search" name="q"
                    value="{{ $search }}" id=""></div>
        </div>
    </form>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered text-center">

        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Description</th>
            <th>Category</th>
            <th>Action</th>
        </thead>
        <tbody>
            @php
                $index = 1;
            @endphp
            @foreach ($products as $item)
                <tr>
                    <td>{{ $index++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td><img class="rounded-circle" src="{{ asset('storage/images/admin/product/' . $item->image) }}" width="100" height="100"
                            alt=""></td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->desc }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td style="width: 200px">
                        <form action="{{ route('products.destroy', $item) }}" method="post">
                            @csrf
                            @method('DELETE')
                            @can('delete-product')
                                <button class="btn btn-danger"
                                    onclick="return confirm('Bạn muốn xoá danh mục này?')">Delete</button>
                            @endcan
                            @can('update-product')
                                <a href="{{ route('products.edit', $item) }}" class="btn btn-primary">Update</a>
                            @endcan
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">{{ $products->links() }}</div>
@endsection
