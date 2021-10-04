@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }}</title>
@endsection

@section('content')

  <div class="col mt-2">
    <div id="product-slider" class="splide h-50 border border-dark">
      <div class="splide__track h-100">
          <div class="splide__list h-100">
            @foreach ($banners as $banner)
              <div class="splide__slide d-flex justify-content-center align-items-center">
                <img src="{{ asset("storage/$banner->banner_path") }}" alt="Placeholder Banner" class="h-100 w-100">
              </div>
            @endforeach
          </div>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="row h-100 no-gutters">
      {{-- <div class="col-2 bg-dark m-2">
        <h1 class="text-white d-flex justify-content-center">SIDEBAR</h1>
      </div> --}}
      <div class="col">
        <div class="row no-gutters mr-auto">
          @foreach ($products as $product)
            <div class="col-3">
              @livewire('product-card-component', ['product' => $product])
            </div>
          @endforeach
        </div>
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
          rewind: true,
        }).mount()
    </script>
@endpush
