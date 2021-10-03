@extends('admin.layouts.master')

@section('meta-title')
    <title>Admin Dashboard</title>
@endsection

@section('content')
    <div>
        <h2>Login to Admin Dashboard</h2>
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf

            <input type="email" value="{{ old('email') }}" name="email" required placeholder="Email">

            <input type="password" name="password" required placeholder="Password">

            <button type="submit">Login</button>
        </form>

        {{-- TODO: REPLACE THIS WITH ADMIN --}}
        @include('browser.layouts.partials.messages')
    </div>
@endsection