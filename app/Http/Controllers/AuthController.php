<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses login pengguna
    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Mengarahkan user ke halaman yang sesuai berdasarkan role_id yang dimiliki
            if (Auth::user()->role_id === 3) {
                return redirect()->route('monitor.bukutamu')->with('success', 'Login sebagai Monitor berhasil!');
            } elseif (Auth::user()->role_id === 2) {
                return redirect()->route('bukutamu.create')->with('success', 'Login sebagai Resepsionis berhasil!');
            } else {
                return redirect()->route('bukutamu.create')->with('success', 'Login sebagai Super Admin berhasil!');
            }
        }

        return back()->with('error', 'Email atau password salah. Silakan coba lagi!')->onlyInput('email');
    }

    // Memproses logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session lama
        $request->session()->invalidate();

        // Regenerasi token CSRF untuk keamanan
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}