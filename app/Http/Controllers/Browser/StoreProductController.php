<?php

namespace App\Http\Controllers\Browser;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StoreProductController extends Controller
{

	private const PATH = "browser.store.product.";

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view(self::PATH . 'index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$currencies = data_from_csv('currencies.csv');

		return view(self::PATH . 'create', ['currencies' => $currencies]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProductStoreRequest $request)
	{
		$product = $request->validated();
		// Product::create($product);

		Product::create([
			'name' => $product['product_name'],
			'price' => $product['price'],
			'currency' => $product['currency'],
			'description' => '',
			'rating' => 0.0,
			'brand' => '',
			'is_public' => false,
			'store_id' => user_store()->id
		]);

		Session::flash('success', 'Successfully Added Product.');

		return redirect()->route('browser.products.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $product)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Product $product)
	{
		return view(self::PATH . 'edit', compact('product'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Product $product)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Product $product)
	{
		//
	}
}
