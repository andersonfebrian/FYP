<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
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
        $total_users = count(User::all());

        $users = User::where('first_name', 'like', '%' . $this->search . '%')
        ->orWhere('last_name', 'like', '%' . $this->search . '%')
        ->orWhere('email', 'like', '%' . $this->search . '%')
        ->orWhere(DB::raw('CONCAT(first_name, " ", last_name)'), 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.admin.user-component', ['users' => $users, 'total_users' => $total_users]);
    }
}
