<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
	protected const PATH = "admin.";

	public function index()
	{
		return view(self::PATH . "home");
	}
}
