@extends('browser.layouts.master')

@section('meta-title')
    <title>{{ $store->name }}</title>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row d-flex justify-content-center">
            <h1>{{ $store->name }}</h1>
        </div>
        <div class="row">
            <div class="col">
                <h2>Store Products</h2>
            </div>
        </div>
        <div class="row mt-2">
            @foreach($store->products as $product) 
            <div class="col-3">
                @livewire('product-card-component', ['product' => $product])
            </div>
            @endforeach
        </div>

        {{-- <ul>
            @foreach ($store->products as $product)
            <li>
                <a href="{{ route('browser.product.show', ['product' => $product]) }}">{{ $product->name }}</a>
            </li>
            @endforeach
        </ul> --}}
    </div>
@endsection