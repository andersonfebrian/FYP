@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }} - Store Dashboard</title>
@endsection

@section('content')
  <div class="container h-100 mt-2">
    <h1>Store Dashboard</h1>
    <div class="row">
      <div class="col">
        <h3>Product</h3>
        <ul>
          <li>
            <a href="{{ route('browser.products.index') }}">Store Products</a>
          </li>
          <li>
            <a href="{{ route('browser.products.create') }}">Add Product</a>
          </li>
        </ul>
      </div>
      <div class="col">
        <h3>Income since signup - <b>MYR </b> {{ $income }}</h3>
      </div>
    </div>
  </div>
@endsection