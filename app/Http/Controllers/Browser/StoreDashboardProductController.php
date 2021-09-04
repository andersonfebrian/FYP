<?php

namespace App\Http\Controllers\Browser;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreUpdateRequest;
use App\Services\Browser\StoreProductService;

class StoreDashboardProductController extends Controller
{
    private const PATH = "browser.store.product.";

	private $storeProductServices;

	public function __construct(StoreProductService $storeProductServices) {
		$this->storeProductServices = $storeProductServices;
	}

	public function index()
	{
		return view(self::PATH . 'index');
	}

	public function create()
	{
		$currencies = data_from_csv('currencies.csv');

		return view(self::PATH . 'create', ['currencies' => $currencies]);
	}

	public function store(ProductStoreUpdateRequest $request)
	{
		return $this->storeProductServices->store($request);
	}

	public function show(Product $product)
	{
		//
	}

	public function edit(Product $product)
	{
		$currencies = data_from_csv('currencies.csv');
		return view(self::PATH . 'edit', compact(['product', 'currencies']));
	}

	public function update(ProductStoreUpdateRequest $request, Product $product)
	{
		return $this->storeProductServices->update($request, $product);
	}
}
