@extends('layouts.admin')
@section('title', 'List Banner')
@section('name-content', 'List Banner')
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
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($orders as $item)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $item->image }}</td>
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
                                    <td><a href="{{ route('bill.detail', $item->id) }}"><i
                                                class="fa fa-exclamation-circle"></i></a></td>
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
