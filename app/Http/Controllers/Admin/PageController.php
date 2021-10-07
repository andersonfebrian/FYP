<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
	protected const PATH = "admin.";

	public function index()
	{
		return view(self::PATH . "home");
	}

	public function users() {
		return view(self::PATH . 'pages.user.index');
	}

	public function stores() {
		return view(self::PATH . 'pages.store.index');
	}

	public function products() {
		return view(self::PATH . 'pages.product.index');
	}

	public function transactions() {
		return view(self::PATH . 'pages.transaction.index');
	}

	public function purchases() {
		return view(self::PATH . 'pages.purchase.index');
	}
}
