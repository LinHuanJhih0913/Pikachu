<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('login/login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only(['email', 'password']))) {
            Auth::login($request->user());
        } else {
            dd('error');
        }

        return redirect('/');
    }

    public function destory()
    {
        auth()->logout();
        return redirect('/');
    }
}
