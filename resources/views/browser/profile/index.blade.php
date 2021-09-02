@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }} - Profile</title>
@endsection

@section('content')

  <div class="container mt-2">
    
    @include('browser.layouts.partials.messages')

    <h1>Profile Page</h1>

    <div class="row mt-4">
      <div class="col">
        <h3>Store Related</h3>
        <ul>
          <li> <a href="{{ route('browser.store-dashboard') }}">Store</a></li>
        </ul>
      </div>
      <div class="col">
        <h3>Settings</h3>
        <ul>
          <li> <a href="{{ route('browser.profile.show') }}"> Edit Profile </a></li>
        </ul>
      </div>
    </div>

  </div>

@endsection