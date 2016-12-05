<?php

namespace App\Http\Controllers\Admin\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return $this->response->array([
            'token' => 'token_123456',
        ]);
    }
}
