<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
	protected const PATH = 'browser.profile.';

	public function index() {
		return view(self::PATH . 'index');
	}

	public function edit() {
		return view(self::PATH . 'edit', ['user' => Auth::user()]);
	}

	public function update(Request $request, User $user) {
		$this->validate($request,[
			'first_name' => 'required',
			'last_name' => 'required',
			'password' => 'nullable|confirmed|min:6',
		]);

		$user->update($request->only(['first_name', 'last_name']));

		if(isset($request->password)) {
			$user->update(['password' => Hash::make($request->password)]);
		}

		Session::flash('success', 'Successfully Updated Profile!');

		return redirect()->route('browser.profile');
	}
}
