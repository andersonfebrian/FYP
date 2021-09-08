<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
	public function register(Request $request)
	{
		$this->validate($request, [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:6',
			'enable_biosecure' => 'boolean'
		]);

		$data = $request->only(['first_name', 'last_name', 'password', 'email']);

		$user = User::create([
			'email' => $request->email, 
			'first_name' => $request->first_name, 
			'last_name' => $request->last_name, 
			'password' => Hash::make($request->password), 
			'biosecure_enabled' => $request->enable_biosecure ?? false
		]);

		Auth::loginUsingId($user->id);

		return redirect()->intended();
	}
}
