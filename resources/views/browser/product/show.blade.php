@extends('browser.layouts.master')

@section('meta-title')

@endsection

@section('content')
    <div class="container mt-4">
        <div class="col h-50">
            <div class="row h-100">
                <div id="image-slider" class="splide h-100 border border-dark">
                    <div class="splide__track h-100">
                        <div class="splide__list h-100">
                            <div class="splide__slide h-100">
                                <img src="{{ asset('images/product1.png') }}">
                            </div>
                            <div class="splide__slide h-100">
                                <img src="{{ asset('images/product2.png') }}">
                            </div>
                            <div class="splide__slide h-100">
                                <img src="{{ asset('images/banner.png') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h2>{{ $product->name }}</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p><i class="fa fa-star star-color"></i> {{ $product->rating }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h4>{{ $product->currency . " " . $product->price }}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-secondary form-control"><i class="fas fa-cart-plus"></i> Add To Cart</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-primary form-control">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col mt-4">
            <h3><b>Product Description</b></h3>
            {!! $product->description !!}
        </div>
        <div class="col mt-4 mb-4">
            <h1>
                Recommended Product from Store
            </h1>
            <div class="container bg-white w-100 h-25 rounded rounded-3 border border-dark">
                <div class="row h-100">
                    <div class="col-3">
                        <div class="row">
                            <div class="col mt-3 mb-2">
                                <div class="d-flex justify-content-center">
                                    <i class="fas fa-store-alt w-50 h-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                                <div class="d-flex justify-content-center">
                                    <p><b>{{ $product->store->name }}</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-secondary btn-sm">VISIT STORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div id="product-slider" class="splide h-100">
                            <div class="splide__track h-100">
                                <div class="splide__list h-100">
                                    <div class="splide__slide border border-dark rounded-3 d-flex justify-content-center align-items-center m-2">
                                        <p>item 1</p>
                                    </div>
                                    <div class="splide__slide border border-dark rounded-3 d-flex justify-content-center align-items-center m-2">
                                        <p>item 2</p>
                                    </div>
                                    <div class="splide__slide border border-dark rounded-3 d-flex justify-content-center align-items-center m-2">
                                        <p>item 3</p>
                                    </div>
                                    <div class="splide__slide border border-dark rounded-3 d-flex justify-content-center align-items-center m-2">
                                        <p>item 4</p>
                                    </div>
                                    <div class="splide__slide border border-dark rounded-3 d-flex justify-content-center align-items-center m-2">
                                        <p>item 5</p>
                                    </div>
                                    <div class="splide__slide border border-dark rounded-3 d-flex justify-content-center align-items-center m-2">
                                        <p>item 6</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        // document.addEventListener('DOMContentLoaded', function() {
            new Splide('#image-slider', {
                drag: true,
                width: "50%",
                height: "50%",
                cover: true,
                autoplay: true,
                rewind: true
            }).mount()

            new Splide('#product-slider', {
                perPage: 3,
                rewind: true,
                type: 'loop'
            }).mount()
        // });
    </script>
@endpush
