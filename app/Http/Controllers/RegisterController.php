<?php

namespace App\Http\Controllers;
use App\models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:150',
            'email'=> 'required|email|unique:users' .auth()->id(),
            'password' => 'required|confirmed|min:3',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt ( $request->password ),

        ]);
            return response()->json([
                'message' => 'User created successfully',
            ], 201);
    }

}
