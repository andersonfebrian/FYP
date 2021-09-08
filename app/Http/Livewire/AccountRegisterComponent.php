<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Services\Browser\AuthService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AccountRegisterComponent extends Component
{

	public $user;
	public $email;

	public $state = 'init';

	protected $authService;

	protected $rules = [
		'email' => 'required|email|unique:users',
		'user.first_name' => 'required|string',
		'user.last_name' => 'required',
		// 'user.email' => 'required|email|unique:users',
		'user.password' => 'required|min:6',
	];

	protected $messages = [
		// 'user.email.required' => 'The :attribute is required',
	];

	protected $validationAttributes = [
		// 'user.email' => 'Email',
		'user.first_name' => 'First Name',
		'user.last_name' => 'Last Name',
		'user.password' => 'Password'
	];

	protected $listeners = ['refreshComponent' => '$refresh', 'registerAccount', 'changeState'];

	public function mount()
	{
	}

	public function registerAccount()
	{

		$this->validate();

		if (isset($this->user['biosecure_enabled']) && $this->user['biosecure_enabled']) {
			$this->emit('biosecure');
			return $this->changeState("biosecure_enabled");
		}

		$this->user['email'] = $this->email;
		return $this->registerWithoutBiosecure($this->user);
	}

	private function registerWithoutBiosecure($user)
	{
		$account = User::create([
			'first_name' => $user['first_name'],
			'last_name' => $user['last_name'],
			'email' => $user['email'],
			'password' => Hash::make($user['password']),
			'biosecure_enabled' => $user['biosecure_enabled'] ?? false,
		]);

		Auth::loginUsingId($account->id);

		return redirect()->intended();
	}

	public function changeState($state)
	{
		return $this->state = $state;
	}

	public function render()
	{
		return view('livewire.account-register-component');
	}
}
