@extends('layouts.admin')
@section('title','Detail Bill')
@section('name-content','Detail Bill')
@section('content')
  
<div class="col-lg-12 grid-margin stretch-card">

  <div class="card">
      <div class="card-body">
          <h4 class="card-title">Detail Bill</h4>

          {{-- <div class="pull-left search">
              <form>
                  <input type="search" class="form-control" placeholder="Search" name="q"
                      value="{{ $search }}">
              </form>
          </div> --}}
          <div class="table-responsive pt-3">
              <table class="table table-bordered text-center">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th colspan="2">Product</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Total</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                         $index=1;   
                    @endphp
                    @foreach ($bills as $item)
                          <tr>
                              <td>{{ $index++ }}</td>
                              <td>{{ $item->product->name }}</td>
                              <td><img src="{{ asset('storage/images/admin/product/'.$item->product->image) }}" width="100" alt=""></td>
                              <td>{{$item->product_quantity}}</td>
                              <td>{{$item->product_price}}</td>
                              <td>{{$item->product_price*$item->product_quantity}}</td>
                          </tr>
                    @endforeach
                  </tbody>
              </table>
              <div class="btn-group mt-1" role="group" aria-label="Basic example">
                  {{ $bills->links() }}
              </div>
          </div>
      </div>
  </div>
</div>
@endsection