<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class StoreProductIndexComponent extends Component
{
	use WithPagination;

	public $search = '';

	protected $paginationTheme = 'bootstrap';

	protected $listeners = ['refreshComponent' => '$refresh', 'deleteProduct'];

	public function deleteProduct(Product $product) {
		$product->delete();
		return $this->emitSelf('refreshComponent');
	}

	public function updatingSearch() {
		$this->resetPage();
	}

	public function mount() {

	}

	public function render()
	{
		$products = user_store()->products()->where('name', 'like', '%'.$this->search.'%')->paginate(5);
		return view('livewire.store-product-index-component', ['products' => $products]);
	}
}
