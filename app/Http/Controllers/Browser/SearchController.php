<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{

	private const PATH = "browser.query-result.";

	public function query(Request $request) {
		$products = Product::where('name', 'like', "%{$request->search}%")->get();
		return view(self::PATH . 'query-page', ['products' => $products, 'keyword' => $request->search]);
	}
}
