@extends('layouts.admin')
@section('name-content')
  New Product
@endsection
@section('title','Create Product')
@section('content')
  <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="" class="form-label">Tên sản phẩm</label>
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
      <label for="" class="form-label">Giá sản phẩm</label>
      <span class="text-danger m-1">
        @error('price')
          {{$message}}
        @enderror
      </span>
      <input class="form-control" type="text" name="price" value="{{old('price')}}">
    </div>
    <!-- Button trigger modal -->
    <input type="hidden" id="inputSize" name='sizes'>
    <button type="button" class="btn btn-primary clickmodal" data-bs-toggle="modal"
        data-bs-target="#AddSizeModal">
        Add size
    </button>
    <div class="modal" id="AddSizeModal" tabindex="-1" aria-labelledby="AddSizeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddSizeModalLabel">Add size</h5>
                </div>
                <div class="modal-body" id="AddSizeModalBody">
                </div>
                <div class="mt-3">
                    <button type="button" class="btn  btn-primary btn-add-size">Add</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
      <label for="" class="form-label">Danh mục sản phẩm</label>
      <span class="text-danger m-1">
        @error('category_id')
          {{$message}}
        @enderror
      </span>
      <select name="category_id" id="" class="form-select">
        <option value="">Select Option</option>
        @foreach ($categories as $item)
          <option value="{{$item->id}}" {{$item->id==old('category_id')?'selected':false}}>{{$item->name}}</option>
        @endforeach
      </select>
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
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- 
<script src="{{ asset('plugin/ckeditor5-build-classic/ckeditor.js') }}"></script> --}}
<script>
let sizes = [{
    id: Date.now(),
    size: '',
    quantity: 0
}];
</script>
<script src="{{ asset('assets/product/product.js') }}"></script>
@endsection