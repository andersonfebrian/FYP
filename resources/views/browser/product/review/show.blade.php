@extends('browser.layouts.master')

@section('meta-title')

@endsection

@section('content')
    <div class="container mt-4">
        <h2>Write a Review for this Purchase!</h2>

        <p>Product Name:  {{ $purchase->product->name }}</p>
        <form action="{{ route('browser.product-review.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="rating">Rating</label>
                    <input value="1" type="range" min="1" max="5" name="rating" oninput="this.nextElementSibling.value = this.value"> <output>1</output>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="review">Write Review</label>
                    <textarea name="review" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>
            </div>

            <input type="number" hidden name="product_id" value="{{ $purchase->product->id }}">
            <input type="number" hidden name="purchase_id" value="{{ $purchase->id }}">

            @include('browser.layouts.partials.messages')

            <button class="btn btn-success form-control mt-2">Submit Review</button>
        </form>
    </div>
@endsection