@extends('layouts.admin')
@section('title','Create Role')
@section('name-content',' Create Role')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">CREATE ROLE</h4>
            <p class="card-description">
                Back
            </p>
            <form class="forms-sample" method="post" action="{{ route('roles.store') }}">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="exampleInputUsername1">Name</label>
                    <input type="text" class="form-control" id="exampleInputUsername1" placeholder="NameRole"
                        name="name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputDisplayName1">DisplayName</label>
                    <input type="text" class="form-control" id="exampleInputDisplayName1" placeholder="DisplayName"
                        name="display_name">
                    @error('display_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputDisplayName1">Group</label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3" name="group">
                        <option value="">Choose</option>
                        <option value="system">System</option>
                        <option value="user">User</option>
                    </select>
                    @error('group')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="row">
                        @foreach ($permissions as $groupName => $permission)
                            <div class="col-md-2">
                                <h4>{{ $groupName }}</h4>
                                @foreach ($permission as $item)
                                    <div class="col form-check form-check-success">

                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="{{ $item->id }}"
                                                name="permission_ids[]">
                                            {{ $item->display_name }}
                                            <i class="input-helper"></i>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                </div>

                <button class="btn btn-primary mr-2">Submit</button>
            </form>
        </div>
    </div>
@endsection