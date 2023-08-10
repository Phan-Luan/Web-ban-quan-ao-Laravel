@extends('layouts.admin')
@section('title','List Role')
@section('name-content',' List Role')
@section('content')
    <div class="card">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body">
            <h4 class="card-title">ROLE</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>DisplayName</th>
                            <th>Group</th>
                            <th style="width: 200px">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $item)
                            <tr>
                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->display_name }}
                                </td>
                                <td>
                                    {{ $item->group }}
                                </td>

                                <td>
                                    <div class="row">
                                        <div class="p-1">
                                            <form action="{{ route('roles.destroy', $item->id) }}" method="post">
                                                <a href="{{ route('roles.edit', $item->id) }}"
                                                    class="btn btn-primary btn-fw">Update</a>
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="btn-group mt-1" role="group" aria-label="Basic example">
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection