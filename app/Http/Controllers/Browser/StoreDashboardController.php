<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class StoreDashboardController extends Controller
{
	public function index() {

		$store_purchased_products = Purchase::whereHas('transaction', function($query) {
			$query->where('payment_status', 'succeeded');
		})->whereIn('product_id', user_store()->products()->pluck('id')->toArray())->get();

		$income = 0.0;

		foreach($store_purchased_products as $product) {
			$income += $product->product->price;
		}

		return view('browser.store.dashboard.index', ['income' => $income]);
	}
}
