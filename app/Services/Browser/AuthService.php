<?php

namespace App\Services\Browser;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{

	//Todo: Remove this class file

	public function __construct(){}

	public function register($user) {
		dd($user);
		$data = User::create([
			'first_name' => $user['first_name'],
			'last_name' => $user['last_name'],
			'email' => $user['email'],
			'password' => Hash::make($user['password']),
			'biosecure_enabled' => $user['biosecure_enabled'] ?? false
		]);

		Auth::loginUsingId($data->id);

		return redirect()->intended();
	}
}
