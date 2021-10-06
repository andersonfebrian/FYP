@extends('admin.layouts.master')

@section('meta-title')

@endsection

@section('content')
    <div class="container mt-4">
        <h1>Create Banner</h1>
        <div class="col">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mt-2">
                    <label for=""></label>
                    <input type="text" name="name" class="form-control" placeholder="Banner Identifier">
                </div>

                <div class="row mt-2">
                    <input type="file" name="banner_image">
                </div>

                <div class="row inline-block mt-2">
                    <input type="checkbox" name="is_viewable" class="mt-1" value="1">
                    <label for="is_viewable" class="ml-2">Viewable?</label>
                </div>

                @include('browser.layouts.partials.messages')

                <div class="row">
                    <button type="submit" class="btn btn-success form-control">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection