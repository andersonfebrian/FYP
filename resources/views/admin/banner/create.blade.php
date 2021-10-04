@extends('admin.layouts.master')

@section('meta-title')

@endsection

@section('content')
    <div class="container mt-4">
        <h1>Create Banner</h1>
        <div>
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <label for=""></label>
                    <input type="text" name="name">
                </div>

                <div class="row">
                    <input type="file" name="banner_image">
                </div>

                <div class="row inline-block">
                    <input type="checkbox" name="is_viewable" class="mt-1" value="1">
                    <label for="is_viewable" class="ml-2">Viewable?</label>
                </div>

                @include('browser.layouts.partials.messages')

                <button type="submit" class="btn btn-success btn-sm">Create</button>
            </form>
        </div>
    </div>
@endsection