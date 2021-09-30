<?php

namespace App\Http\Livewire;

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
		return view('livewire.cart-component', [
			'cart' => auth_user()->cart
		]);
	}
}
