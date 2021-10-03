<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected const PATH = 'admin.auth.';

    public function show() {
        return view(self::PATH . 'login');
    }

    public function login(Request $request) {

        $request->validate([
            'email' => 'string|email|required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1])) {
            return redirect()->intended();
        }

        return redirect()->back()->withErrors('Incorrect email or password or you may not have admin priviledge.');
    }

    public function logout() {
        Auth::logout();
        Session::flush();
        return redirect()->route('admin.login.show');
    }
}
