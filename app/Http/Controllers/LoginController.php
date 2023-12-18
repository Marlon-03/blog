<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function check(request $request)
    {
        $credentials= $request->validate([
            'email'=> 'required|email',
            'password' => 'required',
        ]);

         if (Auth::attempt($credentials)) 
        {
           return response()->json([ 'status' => true ,
           'message' => 'log in successfully',
        ]);
        }
            return response()->json(['status' => false ,
            'message' => 'invalid credentials',
        
        ],401);
    }
    public function logout()
    {
        Auth::logout();
        return response()->json(['status' => true ,
        'message' => 'log out successfully',
     ]);
    }

}
