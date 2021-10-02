<div class="container">
    @include('browser.layouts.partials.messages')
    <div class="w-100 d-flex justify-content-center mt-2">
        <h2 class="m-0">Shopping Cart</h2>
    </div>
    @if(isset($cart) && count($cart->cart_products) > 0)
        <div class="row rounded border mt-3">
            <div class="col-4"></div>
            <div class="col d-flex justify-content-center">
                <p><b>Product</b></p>
            </div>
            <div class="col d-flex justify-content-center">
                <p><b>Price</b></p>
            </div>
            <div class="col d-flex justify-content-center">
                <p><b>Action</b></p>
            </div>
        </div>
        @foreach($cart->cart_products as $cart_product)
            <div class="row shadow border rounded mt-3" style="height: 10rem;">
                <div class="col-4 d-flex justify-content-center align-items-center">
                    @if(count($cart_product->product->product_images) > 0)
                        <img src="{{ asset("storage/{$cart_product->product->product_images->first()->image_path}") }}" class="border" style="width:8.5rem;height:8.5rem">
                    @else
                        <img src="{{ asset('images/no-img.jpg') }}" alt="" style="width: 8.5rem; height:8.5rem;" class="border">
                    @endif
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <p>{{ $cart_product->product->name }}</p>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <p><b>{{ $cart_product->product->currency }}</b> {{ $cart_product->product->price }}</p>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <button class="btn btn-sm btn-danger" wire:click="remove({{ $cart_product }})">Remove Item</button>
                </div>
            </div>
        @endforeach
        <div class="row rounded border mt-3 d-flex justify-content-end">
            <div class="col-3 d-flex justify-content-end">
                <p><b>Total Price</b></p>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row shadow border rounded mt-3 d-flex justify-content-end" style="height: 3.5rem;">
            <div class="col-3 d-flex justify-content-end align-items-center">
                <p><b>MYR</b> {{ $total_price }}</p>
            </div>
            <div class="col-3 d-flex justify-content-end align-items-center">
                <a href="{{ route('browser.payment.show') }}" class="btn btn-sm btn-success">Proceed To Payment</a>
            </div>
        </div>
    @else
        <div class="row d-flex justify-content-center align-items-center shadow rounded border mt-3" style="height: 17.5rem;">
            <h2 class="m-0">Your Cart is Empty!</h2>
        </div>
    @endif
</div>
