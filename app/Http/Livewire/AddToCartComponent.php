<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddToCartComponent extends Component
{

    public $product;

    protected $listeners = [
        'addToCart',
        'refresh' => '$refresh'
    ];

    public function addToCart() {

        if(!Auth::check()) {
            return redirect()->route('browser.login.show');
        }

        if(!isset(auth_user()->cart)) {
            $cart = Cart::create([
                'user_id' => auth_user()->id
            ]);
        }

        CartProduct::create([
            'cart_id' => auth_user()->cart->id ?? $cart->id,
            'product_id' => $this->product->id
        ]);

        return $this->emit('added');
    }

    public function render()
    {
        return view('livewire.add-to-cart-component');
    }
}
