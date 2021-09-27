<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    protected const PATH = "browser.auth.";

    public function forget() {
        return view(self::PATH . 'forget-password');
    }
}
