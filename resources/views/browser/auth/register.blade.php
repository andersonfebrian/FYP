@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }} - Register Account</title>
@endsection

@section('content')

  <div class="container mt-2">
    <h1>Account Registration</h1>

    <form action="{{ route("browser.auth-register") }}" method="POST">
      @csrf

      <input type="text" name="first_name" class="form-control mt-2" placeholder="First Name" required value="{{ old('first_name') }}">

      <input type="text" name="last_name" class="form-control mt-2" placeholder="Last Name" required value="{{ old('last_name') }}">

      <input type="text" name="email" class="form-control mt-2" placeholder="Email" required value="{{ old('email') }}">

      <input type="password" name="password" class="form-control mt-2" placeholder="Password" required>

      @include('browser.layouts.partials.messages')

      <div class="row mt-2">
        <div class="col">
          <div class="d-flex justify-content-end">
            <p class="mt-2 mb-2">Have an account? <a href="{{ route('browser.login.show') }}">Login Here</a></p>
          </div>
        </div>
        <div class="col-2">
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Register Account</button>
          </div>
        </div>
      </div>

    </form>
  </div>
  

@endsection