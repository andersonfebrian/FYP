@extends('admin.layouts.master')

@section('content')

  <div>
    <h1>Admin Home</h1>

    <ul>
      <li><a href="{{ route('admin.users.show') }}">All Users</a></li>
      <li><a href="{{ route('admin.stores.show') }}">All Stores</a></li>
      <li><a href="{{ route('admin.products.show') }}">All Products</a></li>
    </ul>

    <ul>
      <li><a href="{{ route('browser.index') }}">VISIT MARKETPLACE</a></li>
    </ul>

    <a href="{{ route('admin.logout') }}">Logout</a>
  </div>

@endsection