<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\CartProduct;
use Livewire\Component;

class CartComponent extends Component
{

	protected $listener = [
		'refresh' => '$refresh'
	];

	public function remove(CartProduct $cartProduct) {
		$cartProduct->delete();
		return;
	}

	public function render()
	{
		$total_price = 0.0;

		if(!isset(auth_user()->cart)) {
			Cart::create([
				'user_id' => auth_user()->id
			]);
		}

		if(isset(auth_user()->cart->cart_products)) {
			foreach(auth_user()->cart->cart_products as $cart_product) {
				$total_price += $cart_product->product->price;
			}
		}

		return view('livewire.cart-component', [
			'cart' => auth_user()->cart,
			'total_price' => $total_price
		]);
	}
}
