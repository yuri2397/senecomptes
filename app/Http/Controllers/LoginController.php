<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function create()
    {
        if (session()->has('success')) {
            toastr()->success(session()->get('success'));
        }
        if (Auth::check()) {
            return redirect('/profile');
        }
        return view('login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'phone' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('profile');
        } else {
            return back()->withErrors([
                'phone' => 'Le numéro de téléphone ou le mot de passe est incorrect.',
            ])->onlyInput('phone');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
