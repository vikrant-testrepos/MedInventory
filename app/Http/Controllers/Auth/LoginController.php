<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect users after login based on role.
     */
    protected function redirectTo()
    {
        $user = auth()->user();

        if ($user->role == 'admin') {
            return '/admin';
        }

        if ($user->role == 'pharmacy') {
            return '/pharmacy';
        }

        return '/patient';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}