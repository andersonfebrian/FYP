<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function updatingSearch() {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::where('name', 'like', '%'.$this->search.'%')->orWhereHas('store', function($query){
            $query->where('name', 'like', '%'.$this->search.'%');
        })->paginate(10);

        return view('livewire.admin.product-component', ['products' => $products]);
    }
}
