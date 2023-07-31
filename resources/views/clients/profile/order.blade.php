@extends('layouts.client')
@section('content')

    <div class="col-lg-12 grid-margin stretch-card container">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Order</h4>
                @if (isset($message))
                    <p>{{ $message }}</p>
                @else
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Note</th>
                                    <th class="text-center">Payment</th>
                                    <th class="text-center">Ship</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 1;
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
                                        <td>{{ $item->status }}</td>
                                        @if ($item->status == 'Pending')
                                            @foreach (config('order.status') as $status)
                                                @if ($status === 'Cancel')
                                                    <td>
                                                        <button type="button" class="status btn btn-danger form-control-sm"
                                                            value="Cancel"
                                                            data-action="{{ route('clients.orders.update_status', $item->id) }}">
                                                            {{ $status }}
                                                        </button>
                                                    </td>
                                                @endif
                                            @endforeach
                                        @else
                                            @if ($item->status == 'Cancel')
                                                <td>
                                                    <button type="button" disabled
                                                        class="status btn btn-danger form-control-sm">Đã huỷ</button>
                                                </td>
                                            @else
                                                <td>
                                                    <button type="button" disabled
                                                        class="status btn btn-success form-control-sm">Success</button>
                                                </td>
                                            @endif
                                        @endif
                                        <td><a href="{{ route('profile.bill-detail', $item->id) }}"><i class="fa fa-exclamation-circle"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="btn-group mt-1" role="group" aria-label="Basic example">
                            {{ $orders->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $(document).on("click", ".status", function(e) {
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
                location.reload();
            });

        });
    </script>
@endsection
