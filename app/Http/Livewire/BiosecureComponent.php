<?php

namespace App\Http\Livewire;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class BiosecureComponent extends Component
{


	public $user;
	public $email;
	public $password;

	public $frame_count = 0;
	public $from = "login";

	protected $listeners = ['refresh' => '$refresh', 'registered', 'login'];

	public function registered() {
		session()->flash('success', 'Successfully Registered. Please login to Proceed');

		return redirect()->route('browser.login.show');
	}

	public function login(){
		if(Auth::attempt(['email' => $this->email, 'password' => $this->password])) {

			Activity::create([
				'activity' => 'account.login',
				'user_id' => Auth::user()->id,
			]);

			return redirect()->intended();
		} else {			
			session()->flash('error', 'Incorrect Email or Password entered.');
			return redirect()->route('browser.login.show');
		}
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
