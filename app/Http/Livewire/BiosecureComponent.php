<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BiosecureComponent extends Component
{


	public $user;
	public $email;

	protected $listeners = ['biosecure', 'changeState', 'refreshComponent' => '$refresh', 'registered'];

	public function changeState() {
		dd('listened');
	}

	public function registered() {
		// dd('registered');
		$user = User::where('email', $this->email)->first();
		
		Auth::loginUsingId($user->id);

		//session()->flash('success', 'Successfully Registered. Please login to Proceed');

		return redirect()->route('browser.login.show');
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
