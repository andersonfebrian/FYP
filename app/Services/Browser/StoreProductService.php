<?php

namespace App\Services\Browser;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StoreProductService
{

	public function store(Request $request)
	{
		$product = $request->validated();

		Product::create([
			'name' => $product['name'],
			'price' => $product['price'],
			'currency' => $product['currency'],
			'description' => $product['description'],
			'rating' => 0.0,
			'brand' => '',
			'is_public' => isset($product['is_public']) ? $product['is_public'] : false,
			'store_id' => user_store()->id
		]);

		Session::flash('success', 'Successfully Added Product.');

		return redirect()->route('browser.products.index');
	}

	public function update(Request $request, Product $product)
	{
		$data = $request->validated();

		$product->update($data);

		$product->update([
			'is_public' => $data['is_public'] ?? false,
		]);

		Session::flash('success', 'Successfully Updated Product.');

		return redirect()->route('browser.products.index');
	}
}