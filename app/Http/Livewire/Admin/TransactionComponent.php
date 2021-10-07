<?php

namespace App\Http\Livewire\Admin;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionComponent extends Component
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

        $transactions = Transaction::where('transaction_id', 'like', '%'.$this->search.'%')->paginate(10);

        return view('livewire.admin.transaction-component', ['transactions' => $transactions]);
    }
}
