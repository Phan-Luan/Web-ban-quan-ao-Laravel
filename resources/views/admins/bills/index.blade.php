@extends('layouts.admin')
@section('title','List Bills')
@section('name-content','List Bills')
@section('content')
  
<div class="col-lg-12 grid-margin stretch-card">

  <div class="card">
      <div class="card-body">
          <h4 class="card-title">Order</h4>

          <div class="pull-left search">
              <form>
                  <input type="search" class="form-control" placeholder="Search" name="q"
                      value="{{ $search }}">
              </form>
          </div>
          <div class="table-responsive pt-3">
              <table class="table table-bordered text-center">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Address</th>
                          <th>Note</th>
                          <th>Payment</th>
                          <th>Ship</th>
                          <th>Total</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php
                         $index=1;   
                    @endphp
                    @foreach ($orders as $item)
                          <tr>
                              <td>{{ $index++ }}</td>
                              <td>{{ $item->customer_name }}</td>
                              <td>{{ $item->customer_email }}</td>
                              <td>{{ $item->customer_address }}</td>
                              <td>{{ $item->note }}</td>
                              <td>{{ $item->payment }}</td>
                              <td>${{ $item->ship }}</td>
                              <td>${{ $item->total }}</td>
                              <td>
                                <select name="status" class="form-control status form-control-sm"
                                    data-action="{{ route('admins.orders.update_status', $item->id) }}">
                                    @foreach (config('order.status') as $status)
                                        <option value="{{ $status }}"
                                            {{ $status == $item->status ? 'selected' : '' }}>{{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td><a href="{{route('bill.detail',$item->id)}}">!</a></td>
                          </tr>
                    @endforeach
                  </tbody>
              </table>
              <div class="btn-group mt-1" role="group" aria-label="Basic example">
                  {{ $orders->links() }}
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
@section('script')
<script>
  $(function() {
      $(document).on("change", ".status", function(e) {
          e.preventDefault();
          let url = $(this).data("action");
          let data = {
              status: $(this).val()
          };
          $.post(url, data, res => {
              Swal.fire({
                  position: "top-end",
                  icon: "success",
                  title: "Status Updated",
                  showConfirmButton: false,
                  timer: 1500,
              });

          });
      });

  });
</script>

@endsection