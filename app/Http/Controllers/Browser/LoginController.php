<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use App\Models\Activity;
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

			Activity::create([
				'activity' => 'account.login',
				'user_id' => Auth::user()->id,
			]);

			return redirect()->intended();
		}
		return redirect()->back()->withErrors(['message' => 'The Email or Password entered is incorrect.']);
	}
}
