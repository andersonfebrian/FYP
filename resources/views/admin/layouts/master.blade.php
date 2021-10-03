@extends('admin.layouts.partials.main')

@section('master')

  @if(!Route::is('admin.index'))
    <div class="col d-flex justify-content-center">
      <a href="{{ route('admin.index') }}" class="m-2">HOME PAGE</a>
      <a href="{{ route('admin.users.show') }}" class="m-2">ALL USERS</a>
      <a href="{{ route('admin.stores.show') }}" class="m-2">ALL STORES</a>
      <a href="{{ route('admin.products.show') }}" class="m-2">ALL PRODUCTS</a>
    </div>
  @endif

  @yield('content')

@endsection