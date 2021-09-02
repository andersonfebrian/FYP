<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StoreProductIndexComponent extends Component
{

	public $products;

	public function mount() {
		$this->products = user_store()->products;
	}

	public function render()
	{
		return view('livewire.store-product-index-component', ['products' => $this->products]);
	}
}
