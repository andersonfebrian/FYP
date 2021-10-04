@extends('admin.layouts.master')

@section('meta-title')

@endsection

@section('content')
    <div class="container mt-2">
        <h1>Edit Banner Visibility</h1>
        <div class="alert alert-danger">
            <p class="m-0">Due to security reasons, you are not allowed to change the input image. If you want to input a new image, create a new banner and remove/hide the banners which you don't want users to see!</p>
        </div>
        <form action="{{ route('admin.banners.update', ['banner' => $banner]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col">
                    <input type="checkbox" {{ $banner->is_viewable ? 'checked' : '' }} name="is_viewable" value="1">
                    <label for="is_viewable">Viewable?</label>
                </div>
            </div>

            <button type="submit" class="btn btn-success"> Update Banner</button>
        </form>
    </div>
@endsection