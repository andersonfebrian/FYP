<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductCardComponent extends Component
{

	public $product;

	public function render()
	{
		return view('livewire.product-card-component');
	}
}
