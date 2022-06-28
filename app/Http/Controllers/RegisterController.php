<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        $user = User::create(
            $request->validate([
                'name'      => ['required', 'max:50'],
                'email'     => ['required', 'max:50', 'email'],
                'password'  => ['required'],
                'device_id' => ['required']
            ])
        );

        return Redirect::route('register.showForm')
            ->with('message','Successfully registered user: ' . $user->name);
    }
}
