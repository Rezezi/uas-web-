<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi pengguna baru
    public function register(Request $request)
    {
        // Validasi data yang diterima dari form registrasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Simpan data pengguna baru ke dalam database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
            'role' => 'user', // Set default role as user
        ]);

        // Redirect ke halaman login setelah registrasi berhasil
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login pengguna
    public function login(Request $request)
    {
        // Validasi data yang diterima dari form login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah kredensial valid
        if (Auth::attempt($request->only('email', 'password'))) {
            // Dapatkan data pengguna yang sedang login
            $user = Auth::user();
            
            // Cek peran pengguna dan arahkan sesuai peran
            if ($user->role === 'admin') {
                // Redirect ke halaman admin jika role adalah admin
                return redirect('/books')->with('success', 'Login berhasil sebagai admin.');
            } else {
                // Redirect ke halaman user jika role adalah user
                return redirect()->route('user.books')->with('success', 'Login berhasil sebagai user.');
            }
        }

        // Redirect kembali ke form login jika gagal
        return redirect()->back()->with('error', 'Login gagal. Silakan cek kembali email dan password.');
    }

    // Proses logout pengguna
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
