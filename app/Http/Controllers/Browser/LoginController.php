<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function authenticate(Request $request) {
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required'
		]);

		if(Auth::attempt($request->only(['email', 'password']))){
			return redirect()->intended();
		}
		return redirect()->back()->withErrors(['message' => 'not found']);
	}
}
