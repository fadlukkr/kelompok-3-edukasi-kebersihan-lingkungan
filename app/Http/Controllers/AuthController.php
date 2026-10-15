<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Masyarakat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // REGISTER (khusus Masyarakat)
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            // unique:admin juga dicek, karena login memeriksa admin lebih dulu
            'email' => 'required|email|max:100|unique:masyarakat,email|unique:admin,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.unique' => 'Email sudah terdaftar. Gunakan email lain atau login.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Password dan konfirmasi password tidak sesuai.',
        ]);

        $masyarakat = Masyarakat::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password_hash' => Hash::make($request->password),
            'status' => 'aktif',
        ]);

        Auth::guard('web')->login($masyarakat);
        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang '.$masyarakat->nama_lengkap);
    }

    // LOGIN (Admin dulu, lalu Masyarakat)
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password_hash)) {
            if ($admin->status !== 'aktif') {
                return back()->withErrors(['email' => 'Akun admin ini sedang tidak aktif.'])->onlyInput('email');
            }

            Auth::guard('admin')->login($admin);
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang Admin '.$admin->nama_admin);
        }

        $masyarakat = Masyarakat::where('email', $request->email)->first();
        if ($masyarakat && Hash::check($request->password, $masyarakat->password_hash)) {
            if ($masyarakat->status !== 'aktif') {
                return back()->withErrors(['email' => 'Akun Anda telah dinonaktifkan.'])->onlyInput('email');
            }

            Auth::guard('web')->login($masyarakat);
            $request->session()->regenerate();

            return redirect()->route('dashboard')
                ->with('success', 'Selamat datang '.$masyarakat->nama_lengkap);
        }

        return back()->withErrors(['email' => 'Email atau password salah!'])->onlyInput('email');
    }

    // LOGOUT (kedua guard)
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah logout dengan sukses.');
    }
}
