<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $account  = $request->input('account');
        $password = $request->input('password');

//        if ($account == 'lianginet' && $password == 'password') {
//            return 'login success';
//        } else {
//            return 'login failure';
//        }
        return [
            'token' => 'token_123456',
        ];
    }
}
