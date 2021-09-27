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

		$products = Product::where('is_public', 1)->get();


		return view(self::PATH . 'home', ['products' => $products]);
	}
}
