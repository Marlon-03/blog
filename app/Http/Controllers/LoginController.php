<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function check(request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;
    
            // Get the user's role
            $role = $user->roles->pluck('name')->first();
    
            return response()->json([
                'status' => true,
                'message' => 'Logged in successfully',
                'api_token' => $token,
                'role' => $role, // Include the role in the response
            ]);
        }
    
        return response()->json([
            'status' => false,
            'message' => 'Invalid credentials',
        ], 401);
    }
    public function logout()
    {
        Auth::logout();
        return response()->json(['status' => true ,
        'message' => 'log out successfully',
     ]);
    }

}
