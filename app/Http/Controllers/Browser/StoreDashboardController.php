<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreDashboardController extends Controller
{
	public function index() {
		return view('browser.store.dashboard.index');
	}
}
