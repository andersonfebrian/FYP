<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    protected const PATH = "browser.payment.";

    private $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
    }

    public function show() {

        $pending_transaction = Transaction::whereHas('user',  function($query){
            $query->where('id', auth_user()->id);
        })->where('payment_status', 'pending')->first();

        if(count(auth_user()->cart->cart_products) == 0 && !isset($pending_transaction)) {
            return redirect()->route('browser.cart')->withErrors('No products in cart!');
        }

        if(!isset($pending_transaction)) {
            $total_price = 0.0;

            foreach(auth_user()->cart->cart_products as $cart_product) {
                $total_price += $cart_product->product->price;
            }

            $paymentIntent = $this->stripe->paymentIntents->create([
                'amount' => $total_price * 100,
                'currency' => 'myr'
            ]);

            $result = DB::transaction(function () use ($paymentIntent, $total_price) {
                $transaction = Transaction::create([
                    'transaction_id' => uniqid(),
                    'user_id' => auth_user()->id,
                    'payment_intent_id' => $paymentIntent->id,
                    'total_price' => $total_price
                ]);

                foreach(auth_user()->cart->cart_products as $cart_product) {
                    Purchase::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $cart_product->product_id
                    ]);
                    $cart_product->delete();
                }

                return compact(['transaction']);
            });
        }

        if(isset($pending_transaction)) {
            Session::flash('error', 'This is your previous transaction that didn\'t go through! Cancel this transaction to Proceed with new transaction!');
        }

        return view(self::PATH . 'show', ['transaction' => $result['transaction'] ?? $pending_transaction]);
    }
}
