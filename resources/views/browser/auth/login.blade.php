@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }} - Login</title>
@endsection

@section('content')

  <div class="container mt-2">
    <h1>Login</h1>
    <form action="{{ route('browser.auth-login') }}" method="post">
      @csrf
      <input placeholder="Email" type="text" class="form-control mt2" name="email" required>

      <input placeholder="Password" type="password" class="form-control mt-2" name="password" required>
      
      @include('browser.layouts.partials.error-message')

        <div class="row mt-2">
          <div class="col">
            <div class="d-flex justify-content-end">
              <p class="mb-2 mt-2">Don't have an account? <a href="{{ route('browser.register.show') }}">Register Here</a> </p>
            </div>
          </div>
          <div class="col-1">
            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-success">Login</button>
            </div>
          </div>
        </div>

    </form>
  </div>

@endsection