@extends('layouts.admin')
@section('title', 'Create Banner')
@section('name-content', 'Create Banner')
@section('content')
    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2 class="text-center">Thêm banner</h2>
        <div class="form-group">
            <label for="" class="form-label">Banner</label>
            <span class="text-danger m-1">
                @error('image')
                    {{ $message }}
                @enderror
            </span>
            <input class="form-control" type="text" name="image" value="{{ old('image') }}">
        </div>

        <button type="submit" class="btn btn-primary mt-2">Thêm</button>
    </form>
@endsection
