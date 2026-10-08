<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:masyarakat,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $masyarakat = Masyarakat::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password_hash' => Hash::make($request->password),
            'status' => 'aktif',
        ]);

        Auth::login($masyarakat);

        $request->session()->regenerate();

        return redirect('/dashboard');
    }


    // LOGIN
    public function login(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $masyarakat = Masyarakat::where(
        'email',
        $request->email
    )->first();

    if (!$masyarakat || !Hash::check(
        $request->password,
        $masyarakat->password_hash
    )) {
        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ]);
    }

    Auth::login($masyarakat);

    $request->session()->regenerate();

    return redirect('/dashboard');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}