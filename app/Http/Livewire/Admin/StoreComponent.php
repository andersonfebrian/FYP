<?php

namespace App\Http\Livewire\Admin;

use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;

class StoreComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {

        $stores = Store::paginate(10);

        return view('livewire.admin.store-component', ['stores' => $stores]);
    }
}
