<?php

namespace App\Http\Controllers\Browser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class ForgetPasswordController extends Controller
{
    protected const PATH = "browser.auth.";

    public function showForgotPasswordForm() {
        return view(self::PATH . 'forget-password');
    }

    public function showResetPasswordForm(Request $request, $token) {
        return view(self::PATH . 'reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $data = $request->only(['email', 'password', 'password_confirmation', 'token']);

        Password::reset($data, function ($user, $password) {
            $user->update([
                'password' => Hash::make($password),
            ]);
        });

        Session::flash('success', 'Successfully reset password, please login to continue.');

        return redirect()->route('browser.login.show');
    }
}
