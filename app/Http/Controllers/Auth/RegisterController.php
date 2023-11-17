<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {

        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'name' => ['required','min:5','string'],
            'username' => ['required','min:5','max:20','unique:users'],
            'email' => ['required','min:5','max:100','email','unique:users'],
            'password' => ['required','confirmed','min:6',]
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
