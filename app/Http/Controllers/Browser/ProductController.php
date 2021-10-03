<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected const PATH = "browser.product.";

    public function show(Product $product) {

        $recommended = $product->store->products()->where('id', '!=', $product->id)->where('is_public', 1)->inRandomOrder()->limit(10)->get();

        return view(self::PATH . 'show', ['product' => $product, 'recommended' => $recommended]);
    }
}
