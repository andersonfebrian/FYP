<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ForgetPasswordComponent extends Component
{
    public $state = 'init';

    public $email;
    public $password, $password_confirmation;
    public $user;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'confirmed|min:6'
    ];

    protected $listeners = ['refresh' => '$refresh', 'changeState'];

    public function accountExists() {
        $this->user = User::where('email', $this->email)->first();

        if(!isset($this->user)) {
            session()->flash('error', 'Unable to find User record in our Database.');
            return;
        }

        $this->user = $this->user->toArray();

        if($this->user['biosecure_enabled']) {
            return $this->changeState('biosecure_enabled');
        } else {
            return $this->changeState('reset_password');
        }
    }

    public function changeState($state) {
        $this->state = $state;
        return $this->emit('refresh');
    }

    public function resetPassword() {
        $validated = $this->validate([
            'password' => 'confirmed|min:6|required',
            'password_confirmation' => 'min:6|required'
        ]);

        $user = User::firstWhere('email', $this->email);

        $user->update([
            'password' => Hash::make($this->password),
        ]);

        session()->flash('success', 'Successfully Reset Password. Please Login to Continue.');

        return redirect()->route('browser.login.show');
    }

    public function render()
    {
        return view('livewire.forget-password-component');
    }
}
