<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function showForm()
    {
        return Inertia::render('Register', []);
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'max:50'],
            'email'     => ['required', 'max:50', 'email', 'unique:users,email'],
            'password'  => ['required'],
            'device_id' => ['required']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
            'device_id' => $request->device_id,
        ]);

        return Redirect::route('register.showForm')
            ->with('message','Successfully registered user: ' . $user->name);
    }
}
