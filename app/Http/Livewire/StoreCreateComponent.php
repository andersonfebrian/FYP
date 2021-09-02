<?php

namespace App\Http\Livewire;

use App\Models\Activity;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StoreCreateComponent extends Component
{

	public $create = false;

	public $store_name, $checkbox;

	protected $listeners = ['create' => '$refresh'];

	protected $rules = [
		'store_name' => 'required|min:3',
		'checkbox' => 'required|boolean',
	];

	public function createStore() {
		$this->validate();

		$store_name = $this->store_name;

		Store::create([
			'name' => $store_name,
			'user_id' => Auth::id(),
		]);

		session()->flash('success', 'Successfully Opened Store!');

		return redirect()->to('/store-dashboard');
	}

	public function changeStatus() {
		$this->create = !$this->create;
		return $this->emitSelf('create');
	}

	public function render()
	{
		return view('livewire.store-create-component');
	}
}
