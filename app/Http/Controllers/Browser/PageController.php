<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
	protected const PATH= "browser.";

	public function index()
	{

		if(Auth::check() && isset(auth_user()->store)) {
			$products = Product::where('is_public', 1)->whereNotIn('id', user_store()->products->pluck(['id']))->inRandomOrder()->get();
		} else {
			$products = Product::inRandomOrder()->where('is_public', 1)->get();
		}

		$banners = Banner::where('is_viewable', 1)->inRandomOrder()->limit(5)->get();

		return view(self::PATH . 'home', ['products' => $products, 'banners' => $banners]);
	}
}
