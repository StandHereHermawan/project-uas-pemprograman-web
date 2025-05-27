<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function account(Request $request)
    {
        /**
         * @var string
        */
        $decryptedLoginToken = $request->cookie('X-LOGIN-TOKEN');
        $email = $decryptedLoginToken;

        /**
         * @var \App\Models\User
        */
        $userModel = User::select()->where('email', '=', $email)->first();

        return view('auth.account')
            ->with('name', $userModel->name)
            ->with('email', $userModel->email);
    }
}
