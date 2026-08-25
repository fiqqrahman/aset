<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan Halaman Form Login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Eksekusi Otentikasi User (NIP / Email & Password)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required'    => 'NIP / Email wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        // Fleksibilitas: Cek apakah inputan berupa format Email atau NIP/Username
        $loginType = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'nip';

        $loginData = [
            $loginType => $credentials['email'],
            'password' => $credentials['password'],
        ];

        $remember = $request->boolean('remember');

        if (Auth::attempt($loginData, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'NIP/Email atau kata sandi yang Antum masukkan tidak cocok.',
        ])->onlyInput('email');
    }

    /**
     * Destroy Session & Logout User
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Antum telah berhasil keluar dari sistem.');
    }
}
