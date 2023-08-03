@extends('layouts.client')
@section('title_page', 'My Profile')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            margin-top: 20px;
            background: #f8f8f8
        }

        .container {
            margin-bottom: 100px;
        }
    </style>
    <div class="container">
        <div class="row flex-lg-nowrap">
            <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
                <div class="card p-3">
                    <div class="e-navlist e-navlist--active-bg">
                        <ul class="nav">
                            <li class="nav-item"><a class="nav-link text-dark px-2 active"
                                    href="{{ route('client.profile', auth()->user()->id) }}">
                                    <i class="fa fa-fw fa-user mr-1"></i><span>My Profile</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="e-navlist e-navlist--active-bg">
                        <ul class="nav">
                            <li class="nav-item"><a class="nav-link text-dark px-2 active"
                                    href="{{ route('client.order', auth()->user()->id) }}">
                                    <i class="fa fa-fw fa-cart-arrow-down mr-1"></i><span>My Order</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="e-profile">
                                    <div class="row">
                                        <div class="col-12 col-sm-auto mb-3">
                                            <div class="mx-auto" style="width: 140px;">
                                                <div class="d-flex justify-content-center align-items-center rounded"
                                                    style="height: 140px; background-color: rgb(233, 236, 239);">
                                                    <img style="height: 100%;width: 100%;"
                                                        src="{{ asset('storage/images/admin/user/' . $user->image) }}"
                                                        alt="avatar">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                            <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ $user->name }}</h4>
                                                <div class="text-muted"><small>Last seen 2 hours ago</small></div>
                                                <form class="form" action="{{ route('client.updateProfile', $user->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mt-2">
                                                        <input type="file" name="image" id="">
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
                                    </ul>
                                    <div class="tab-content pt-3">
                                        <div class="tab-pane active">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Username</label>
                                                                <input class="form-control" type="text" name="name"
                                                                    placeholder="Username"
                                                                    value="{{ $user->name ?? old('name') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Phone</label>
                                                                <input class="form-control" type="number" name="phone"
                                                                    placeholder="0965433333"
                                                                    value="{{ $user->phone ?? old('phone') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input class="form-control" type="email"
                                                                    placeholder="user@example.com" name="email"
                                                                    value="{{ $user->email ?? old('email') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input class="form-control" type="text"
                                                                    placeholder="Nam Từ Liêm" name="address"
                                                                    value="{{ $user->address ?? old('address') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputGender">Gender</label>
                                                        <select class="form-control form-control-sm"
                                                            id="exampleFormControlSelect3" value="{{ old('gender') }}"
                                                            name="gender">
                                                            <option value="male"
                                                                {{ $user->gender == 'male' ? 'selected' : '' }}>Male
                                                            </option>
                                                            <option value="female"
                                                                {{ $user->gender == 'female' ? 'selected' : '' }}>
                                                                Female</option>
                                                        </select>
                                                        @error('gender')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">Save
                                                        Changes</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
