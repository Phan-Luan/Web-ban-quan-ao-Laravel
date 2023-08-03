@extends('layouts.admin')
@section('title','Create User')
@section('name-content')
  Create User
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <p class="card-description">
                Back
            </p>
            <form class="forms-sample" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="exampleInputUsername1">Avatar</label>
                    <input type="file" class="form-control" value="{{ old('image') }}" id="exampleInputUsername1"
                        placeholder="NameUser" name="image">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername1">Name</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" id="exampleInputUsername1"
                        placeholder="NameUser" name="name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" value="{{ old('email') }}" id="exampleInputEmail1"
                        placeholder="Email" name="email">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" value="{{ old('password') }}" id="exampleInputPassword1"
                        placeholder="Password" name="password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPhone1">Phone</label>
                    <input type="number" class="form-control" value="{{ old('phone') }}" id="exampleInputPhone1"
                        placeholder="phone" name="phone">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputGender">Gender</label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect3" value="{{ old('gender') }}"
                        name="gender">
                        <option value="">Choose</option>
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select>
                    @error('gender')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleTextarea1">Address</label>
                    <textarea class="form-control" value="{{ old('address') }}"  name="address"></textarea>
                </div>
                <div class="form-group">
                    <div class="row">
                        @foreach ($roles as $groupName => $role)
                            <div class="col-md-2">
                                <h4>{{ $groupName }}</h4>
                                @foreach ($role as $item)
                                    <div class="col form-check form-check-success">

                                        <label class="form-check-label">
                                            <input type="checkbox" value="{{ $item->id }}" class="form-check-input"
                                                name="role_ids[]">
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