<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
	protected $authService;

	private const PATH = "browser.auth.";

	public function __construct()
	{
	}

	public function login(Request $request)
	{
		return view(self::PATH . 'login');
	}

	public function register()
	{
		return view(self::PATH . 'register');
	}

	public function logout()
	{

		Activity::create([
			'user_id' => Auth::user()->id,
			'activity' => 'account.logout'
		]);

		Session::flush();
		Auth::logout();
		return redirect()->route('browser.index');
	}
}
