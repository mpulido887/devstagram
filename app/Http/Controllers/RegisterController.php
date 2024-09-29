<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    function index() {
        return view('auth.register');
    }

    public function store(Request $request) {

        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:30'],
            'username' => ['required', 'unique:users', 'min:5', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:60', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'username' => Str::slug($request->username),
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        //Autenticar al usuario
        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('posts.index');
    }
}
