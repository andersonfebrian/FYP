@extends('admin.layouts.partials.main')

@section('master')

  @if(!Route::is('admin.index') && !Route::is('admin.login.show'))
    <div class="col d-flex justify-content-center">
      <a href="{{ route('admin.index') }}" class="m-2">HOME PAGE</a>
      <a href="{{ route('admin.users.index') }}" class="m-2">ALL USERS</a>
      <a href="{{ route('admin.stores.index') }}" class="m-2">ALL STORES</a>
      <a href="{{ route('admin.products.index') }}" class="m-2">ALL PRODUCTS</a>
      <a href="{{ route('admin.banners.index') }}" class="m-2">MANAGE BANNERS</a>
      <a href="{{ route('admin.activity-logs.index') }}" class="m-2">VIEW LOGS</a>
    </div>
  @endif

  @yield('content')

@endsection