@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }} - Login</title>
@endsection

@section('content')

  <div class="container mt-2">

    @if(session()->has('success'))
      <div class="alert alert-success">
        <p>{{session('success')}}</p>
      </div>
    @endif

    <h1>Profile Page</h1>
    <ul>
      <li>Purchase History</li>
      <li> <a href="{{ route('browser.store-dashboard') }}">Store</a></li>
      <li> <a href="{{ route('browser.profile.show') }}"> Edit Profile </a></li>
    </ul>
  </div>

@endsection