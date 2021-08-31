<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	protected const PATH = 'browser.profile.';

	public function index() {
		return view(self::PATH . 'index');
	}
}
