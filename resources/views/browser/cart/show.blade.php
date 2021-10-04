@extends('browser.layouts.master')

@section('meta-title')
    <title>Your Cart Items - {{ config('app.name') }}</title>
@endsection

@section('content')

    @livewire('cart-component')

    <div class="row">
        
    </div>

    <div class="container mt-4 p-0">
        <h4>You may also like</h4>
        <div class="col rounded-3 shadow h-25">
            <div id="product-slider" class="splide h-100">
                <div class="splide__track h-100">
                    <div class="splide__list h-100">
                        @foreach($products as $key=>$product)
                            <div class="splide__slide shadow rounded-3 d-flex justify-content-center align-items-center m-2">
                                <a href="{{ route('browser.product.show', $product) }}">{{ $key+1 . '. ' . $product->name }}</a>
                            </div>
                        @endforeach
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
        new Splide('#product-slider', {
            perPage: 5,
            rewind: true,
            type: 'loop'
        }).mount()
    </script>
@endpush