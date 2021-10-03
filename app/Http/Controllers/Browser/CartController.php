<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    private const PATH = "browser.cart.";

    public function show() {
        $randomProducts = Product::where('is_public', 1)->whereNotIn('id', auth_user()->cart->cart_products->pluck('product_id'))->inRandomOrder()->limit(10)->get();

        return view(self::PATH . 'show', [
            'products' => $randomProducts,
        ]);
    }
}
