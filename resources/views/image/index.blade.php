@extends('layouts.app')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Image Upload</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image">Select Image</label>
                    <input type="file" name="image" id="" class="form-control">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
            @foreach ($images as $image)
                <img src="{{ asset($image->path) }}" alt="flower-g635e21bb6_640">

            @endforeach
        </div>
    </div>
</div>

@endsection
