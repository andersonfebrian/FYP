<?php

namespace App\Http\Livewire;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccountLoginComponent extends Component
{
	public $state = 'init';
	public $user;

	public $email, $password;

	protected $rules = [
		'email' => 'required|email',
		'password' => 'required'
	];

	protected $listeners = ['refresh' => '$refresh', 'changeState', 'login'];

	public function login()
	{
		$this->validate();

		$user = User::where('email', $this->email)->first();
		
		if(isset($user->biosecure_enabled) && $user->biosecure_enabled) {
			$this->user = $user->toArray();
			return $this->changeState('biosecure_enabled');
		}

		if(Auth::attempt(['email' => $this->email, 'password' => $this->password])) {

			Activity::create([
				'activity' => 'account.login',
				'user_id' => Auth::user()->id,
			]);

			return redirect()->intended();
		}

		session()->flash('error', 'The email or password entered is incorrect.');
	}

	public function changeState($state)
	{
		$this->state = $state;
		// return $this->emit('refresh');
	}

	public function render()
	{
		return view('livewire.account-login-component');
	}
}
