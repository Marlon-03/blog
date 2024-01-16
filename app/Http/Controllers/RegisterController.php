<?php

namespace App\Http\Controllers;
use App\models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'name'=> 'required|string|max:150',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:3',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    $userRole = Role::where('name', 'contributor')->first();
    $user->roles()->attach($userRole);

    // Log the user in
    Auth::login($user);

    // Redirect the user to the home page
    return redirect()->intended('home');
}

}
