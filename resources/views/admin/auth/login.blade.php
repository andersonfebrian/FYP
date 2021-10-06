@extends('admin.layouts.master')

@section('meta-title')
    <title>Admin Dashboard</title>
@endsection

@section('content')
    <div class="container">
        <h2>Login to Admin Dashboard</h2>
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf

            <div class="mt-2">
                <input type="email" value="{{ old('email') }}" name="email" required placeholder="Email" class="form-control">
            </div>

            <div class="mt-2">
                <input type="password" name="password" required placeholder="Password" class="form-control">
            </div>

            <button type="submit" class="btn btn-success form-control mt-2">Login</button>
        </form>

        {{-- TODO: REPLACE THIS WITH ADMIN --}}
        @include('browser.layouts.partials.messages')
    </div>
@endsection