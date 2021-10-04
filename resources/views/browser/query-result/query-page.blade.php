@extends('browser.layouts.master')

@section('meta-title')
  <title>Search Result for: {{ config('app.name') }}</title>
@endsection

@section('content')
  <div class="container mt-4">
    <h1>Products with keyword: {{ $keyword }}</h1>

    @if(count($products) == 0)
      <div class="col d-flex justify-content-center">
        <p>No products found...</p>
      </div>
    @else
      <div class="row">
        @foreach($products as $product) 
          <div class="col-3">
            @livewire('product-card-component', ['product' => $product])
          </div>
        @endforeach
      </div>
    @endif
  </div>
@endsection