<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Purchase;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductReviewController extends Controller
{
    private const PATH = 'browser.product.review.';

    public function show(Purchase $purchase) {

        if($purchase->is_reviewed) {
            return redirect()->back()->withErrors('You have already reviewed this product!');
        }

        return view(self::PATH . 'show', ['purchase' => $purchase]);
    }

    public function store(Request $request) {

        $request->validate([
            'rating' => 'required',
            'product_id' => 'required|numeric',
            'purchase_id' => 'required|numeric'
        ]);

        DB::transaction(function () use($request) {
            $purchase = Purchase::find($request->purchase_id);
            $purchase->update([
                'is_reviewed' => !$purchase->is_reviewed
            ]);
            ProductReview::create([
                'user_id' => auth_user()->id,
                'product_id' => $request->product_id,
                'rating' => $request->rating,
                'review' => $request->review ?? null,
            ]);
        });

        Session::flash('success', 'Successfully Review Product!');

        return redirect()->route('browser.purchase-history');
    }
}
