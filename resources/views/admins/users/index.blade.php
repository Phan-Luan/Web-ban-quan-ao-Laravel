@extends('layouts.admin')
@section('name-content')
  List User
@endsection
@section('title','List User')
@section('content')
{{-- <form  action="">
  <div class="input-group d-flex align-items-center my-2 justify-content-end">
    <div>Search:</div>
    <div class=""><input class="form-control mx-1" style="width: 200px" type="search" name="q" value="{{$search}}" id=""></div>
  </div>
</form> --}}

  @section('content')
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
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- <div class="pull-left search">
                    <form>
                        <input type="search" class="form-control" placeholder="Search" name="q"
                            value="{{ $search }}">
                    </form>
                </div> --}}
                <div class="table-responsive pt-3">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Image
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Phone
                                </th>
                                <th>
                                    Gender
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/images/admin/user/'.$item->image) }}" alt="" width="100" height="100">
                                    </td>
                                    <td>
                                        {{ $item->email }}
                                    </td>
                                    <td>
                                        {{ $item->phone }}
                                    </td>
                                    <td>
                                        {{ $item->gender }}
                                    </td>
                                    <td>
                                        <div class="row">
                                                <div class="p-1">
                                                    <form action="{{ route('users.destroy', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        @can('delete-user')
                                                        <button class="btn btn-danger">Delete</button>
                                                        @endcan
                                                        @can('delete-user')
                                                        <a href="{{ route('users.edit', $item->id) }}"
                                                            class="btn btn-info btn-fw">Update</a>
                                                        @endcan
                                                    </form>
                                                </div>
                                             
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    <div class="btn-group mt-1" role="group" aria-label="Basic example">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection