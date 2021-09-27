@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }}</title>
@endsection

@section('content')

<div id="product-slider" class="splide h-50">
  <div class="splide__track h-100">
      <div class="splide__list h-100">
          <div class="splide__slide d-flex justify-content-center align-items-center">
              <p>item 1</p>
          </div>
          <div class="splide__slide d-flex justify-content-center align-items-center">
              <p>item 2</p>
          </div>
          <div class="splide__slide d-flex justify-content-center align-items-center">
              <p>item 3</p>
          </div>
          <div class="splide__slide d-flex justify-content-center align-items-center">
              <p>item 4</p>
          </div>
          <div class="splide__slide d-flex justify-content-center align-items-center">
              <p>item 5</p>
          </div>
          <div class="splide__slide d-flex justify-content-center align-items-center">
              <p>item 6</p>
          </div>
      </div>
  </div>
</div>

  <div class="row h-100 no-gutters">
    <div class="col-2 bg-dark m-2">
      <h1 class="text-white d-flex justify-content-center">SIDEBAR</h1>
    </div>
    <div class="col">
      <div class="row no-gutters mr-auto">
        @foreach ($products as $product)
          <div class="col-3 m-auto">
            @livewire('product-card-component', ['product' => $product])
          </div>
        @endforeach
      </div>
    </div>
  </div>
 
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <script>
        new Splide('#product-slider', {
          autoplay: true,
          rewind: true
        }).mount()
    </script>
@endpush
