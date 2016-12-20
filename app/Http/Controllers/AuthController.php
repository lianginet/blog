<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $account  = $request->input('account');
        $password = $request->input('password');

        $admin = Admin::wherePassword(md5($password))->first();
        if ($admin && $admin->account === $account) {
            $admin->update(['token' => md5(time() . $admin->id)]);
            $admin->password = '';
            return $admin;
        } else {
            return 0;
        }
    }
}
