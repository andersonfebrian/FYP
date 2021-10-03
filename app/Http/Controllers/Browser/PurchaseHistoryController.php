<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    private const PATH = "browser.purchase-history.";

    public function show() {

        $transactions = auth_user()->transactions()->where('payment_status', 'succeeded')->orderBy('updated_at', 'desc')->get();

        return view(self::PATH . 'show', ['transactions' => $transactions]);
    }
}
