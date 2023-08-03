@extends('layouts.admin')
@section('name-content')
    Edit Uesr
@endsection
@section('title','Update User')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-description">

                    </p>
                    <form class="forms-sample" action="{{ route('users.update', $user->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Avata</label>
                                    <input type="file" name="image" id="image-input" class="file-upload-default">
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" class="form-control" value="{{ old('name') ?? $user->name }}"
                                id="exampleInputUsername1" placeholder="NameUser" name="name">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" value="{{ old('email') ?? $user->email }}"
                                id="exampleInputEmail1" placeholder="Email" name="email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhone1">Phone</label>
                            <input type="text" class="form-control" value="{{ old('phone') ?? $user->phone }}"
                                id="exampleInputPhone1" placeholder="phone" name="phone">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputGender">Gender</label>
                            <select class="form-control form-control-sm" id="exampleFormControlSelect3"
                                value="{{ old('gender') ?? $user->gender }}" name="gender">
                                <option value="">Choose</option>
                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleTextarea1">Address</label>
                            <textarea class="form-control" id="exampleTextarea1" rows="4" name="address">{{ old('address') ?? $user->address }}</textarea>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                @foreach ($roles as $groupName => $role)
                                    <div class="col-md-2">
                                        <h4>{{ $groupName }}</h4>
                                        @foreach ($role as $item)
                                            <div class="col">
                                                <p class="mb-2">{{ $item->display_name }}</p>
                                                <label class="toggle-switch toggle-switch-success">
                                                    <input type="checkbox" value="{{ $item->id }}"
                                                        {{ $user->roles->contains('id', $item->id) ? 'checked' : '' }}
                                                        name="role_ids[]">
                                                    <span class="toggle-slider round"></span>
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
        </div>
    </div>
@endsection
