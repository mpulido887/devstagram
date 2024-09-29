<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    Public function index() {
        return view('auth.login');
    }

    Public function store(Request $request) {
        $this->validate($request, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],
        ]);

        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Credenciales incorrectas');
        }

        return redirect()->route('posts.index', auth()->user()->username);


    }
}
