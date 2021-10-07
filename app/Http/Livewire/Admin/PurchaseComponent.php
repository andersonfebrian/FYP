<?php

namespace App\Http\Livewire\Admin;

use App\Models\Purchase;
use Livewire\Component;
use Livewire\WithPagination;

class PurchaseComponent extends Component
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
        $purchases = Purchase::paginate(10);

        return view('livewire.admin.purchase-component', ['purchases' => $purchases]);
    }
}
