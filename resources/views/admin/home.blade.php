@extends('admin.layouts.master')

@section('content')

  <div>
    <h1>Admin Home</h1>

    <ul>
      <li><a href="{{ route('admin.users.index') }}">All Users</a></li>
      <li><a href="{{ route('admin.stores.index') }}">All Stores</a></li>
      <li><a href="{{ route('admin.products.index') }}">All Products</a></li>
      <li><a href="{{ route('admin.banners.index') }}">Manage Site Banners</a></li>
      <li><a href="{{ route('admin.activity-logs.index') }}">View Activity Logs</a></li>
      <li><a href="{{ route('admin.transactions.index') }}">All Transactions</a></li>
      <li><a href="{{ route('admin.purchases.index') }}">All Purchases</a></li>
    </ul>

    <ul>
      <li><a href="{{ route('browser.index') }}">VISIT MARKETPLACE</a></li>
      <li> <a href="{{ route('admin.logout') }}">Logout</a></li>
    </ul>

  </div>

@endsection