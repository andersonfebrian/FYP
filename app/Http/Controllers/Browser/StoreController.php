<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

	public function __construct(){}

	public function create() {

		if(Auth::user()->hasStore()) {
			return redirect()->route('browser.store-dashboard');
		}

		return view('browser.store.create');
	}
}
