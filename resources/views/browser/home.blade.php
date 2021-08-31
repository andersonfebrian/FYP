@extends('browser.layouts.master')

@section('meta-title')
  <title>{{ config('app.name') }}</title>
@endsection

@section('content')

  <div id="carouselExampleIndicators" class="carousel slide h-50" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner h-100">
      <div class="carousel-item active">
        <img src="{{ asset('images/banner-sample-1.jpg') }}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/banner-sample-2.png') }}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="row h-100 no-gutters">
    <div class="col-2 bg-dark">
      <h1 class="text-white d-flex justify-content-center">SIDEBAR</h1>
    </div>
    <div class="col ml-auto mr-auto">
      @foreach ($products as $product)
        @livewire('product-card-component', ['product' => $product])
      @endforeach
    </div>
  </div>

@endsection