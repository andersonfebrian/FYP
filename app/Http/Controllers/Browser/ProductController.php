<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected const PATH = "browser.product.";

    public function show(Product $product) {
        return view(self::PATH . 'show', ['product' => $product]);
    }
}
