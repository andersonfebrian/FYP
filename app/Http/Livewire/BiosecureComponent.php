<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BiosecureComponent extends Component
{


	public $user;
	public $email;

	protected $listeners = ['biosecure', 'changeState', 'refreshComponent' => '$refresh'];

	public function changeState() {
		dd('listened');
	}

	public function biosecure()
	{
		//dd('listened');
		return $this->emit('refreshComponent');
	}

	public function mount($user, $email) {
		$this->user = $user;
		$this->email = $email;
	}

	public function render()
	{
		return view('livewire.biosecure-component');
	}
}
