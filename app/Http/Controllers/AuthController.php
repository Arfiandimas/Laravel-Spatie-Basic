<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
        
        $user = User::where('email', $request->email)->first();

        if($user)
        {
            $check_password = Hash::check($request->password, $user->password);
            if ($check_password) {
                $token = $user->createToken('My Token',['admin']);
                $user->token = $token->accessToken;
            } else {
                return ngcApiFailed('Sign In Failed');        
            }
        } else {
            return ngcApiFailed('User not registered');
        }

        return ngcApiReturn($user);
    }
}
