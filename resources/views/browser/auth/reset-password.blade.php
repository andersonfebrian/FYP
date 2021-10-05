@extends('browser.layouts.master')

@section('meta-title')
    <title>Reset Password - Market Place</title>
@endsection

@section('content')
    <div class="container mt-4">
        <h1>Reset Password</h1>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <label for="password"> Password</label>
            <input type="password" name="password" class="form-control" required>

            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>

            <input type="text" hidden readonly value="{{ $token }}" name="token">
            <input type="email" hidden readonly value="{{ $email }}" name="email">

            @include('browser.layouts.partials.messages')

            <button class="btn btn-success form-control mt-2">Reset Password</button>
        </form>
    </div>
@endsection