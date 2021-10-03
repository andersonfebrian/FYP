@extends('browser.layouts.master')

@section('meta-title')

@endsection

@section('content')
    <div class="container mt-4">
        <h2>{{ $store->name }}</h2>
        <div class="mt-3">
            <ul>
                @foreach ($store->products as $product)
                <li>
                    <a href="{{ route('browser.product.show', ['product' => $product]) }}">{{ $product->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection