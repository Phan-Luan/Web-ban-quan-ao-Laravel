@extends('layouts.admin')
@section('title','Update Coupon')
@section('content')
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <h4 class="card-title">EDIT COUPON</h4>
              <p class="card-description">

              </p>
              <form class="forms-sample" method="post" action="{{ route('coupons.update', $coupon->id) }}">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1"
                          placeholder="Name" name="name" value="{{ old('name') ?? $coupon->name }}"  style="text-transform: uppercase">
                      @error('name')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="exampleInputUsername1">Value</label>
                      <input type="text" class="form-control" id="exampleInputValue1"
                          placeholder="Value" name="value" value="{{ old('value') ?? $coupon->value }}">
                      @error('value')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="">Type</label>
            
                          <select class="form-control form-control-sm" data-style="btn btn-danger btn-block" name="type"  value="{{ old('type') ?? $coupon->type}}">
                              <option value="">Select Type</option>
                              <option value="money" {{ (old('type') ?? $coupon->type) == 'money' ? 'selected' : '' }}>Money</option>
                          </select>
                
                      @error('type')
                          <span class="text-danger">
                              {{ $message }}
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label for="">ExperyDate</label>
                      <input type="date" name="expery_date" class="form-control" value="{{ old('expery_date') ?? $coupon->expery_date }}">
                      @error('expery_date')
                          <span class="text-danger">
                              {{ $message }}
                          </span>
                      @enderror
                  </div>


                  <button class="btn btn-primary mr-2">Submit</button>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection