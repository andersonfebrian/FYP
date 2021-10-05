<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    private const PATH = "browser.cart.";

    public function show()
    {
        if (Auth::check() && isset(auth_user()->store)) {
            if(isset(auth_user()->cart->cart_products)) {
                $randomProducts = Product::where('is_public', 1)->whereNotIn('id', auth_user()->cart->cart_products->pluck('product_id'))->whereNotIn('id', auth_user()->store->products->pluck(['id']))->inRandomOrder()->limit(10)->get();
            } else {
                $randomProducts = Product::where('is_public', 1)->whereNotIn('id', auth_user()->store->products->pluck(['id']))->inRandomOrder()->limit(10)->get();
            }
        } else {
            if (!isset(auth_user()->cart->cart_products)) {
                $randomProducts = Product::where('is_public', 1)->inRandomOrder()->limit(10)->get();
            } else {
                $randomProducts = Product::where('is_public', 1)->whereNotIn('id', auth_user()->cart->cart_products->pluck('product_id'))->inRandomOrder()->limit(10)->get();
            }
        }

        return view(self::PATH . 'show', [
            'products' => $randomProducts,
        ]);
    }
}
