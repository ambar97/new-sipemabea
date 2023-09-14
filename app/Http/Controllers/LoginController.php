<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index()
    {
        return view('admin.login');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'operator') {
                return redirect('admin/operator');
            } elseif (Auth::user()->role == 'panitia') {
                return redirect('admin/panitia');
            }
        } else {
            return redirect('/log')->withErrors('Username atau Password yang dimasukkan tidak sesuai')->withInput();
        }
    }
    function logout()
    {
        Auth::logout();
        return redirect('/log');
    }
}
