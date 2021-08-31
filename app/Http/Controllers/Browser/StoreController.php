<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

	public function __construct(){}

	public function dashboard() {

		if(!Auth::user()->hasStore()) {
			return redirect('store');
		}

		return view('browser.profile.store-index');
	}

	public function index() {

		if(Auth::user()->hasStore()) {
			return redirect('store-dashboard');
		}

		return view('browser.store.index');
	}
}
