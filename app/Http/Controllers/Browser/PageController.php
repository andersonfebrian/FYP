<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
	protected const PATH= "browser.";

	public function index()
	{

		$products = Product::all();


		return view(self::PATH . 'home', ['products' => $products]);
	}
}
