<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    // Menampilkan form registrasi
   
   
    public function tampilRegistrasiUser()
    {
        return view('auth.registrasi-jobseeker');
    }

    // Memproses data registrasi
    public function submitRegistrasiUser(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // pastikan form punya field 'password_confirmation'
        ]);

        try {
            // Simpan user baru

            $user = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password); // Enkripsi password
            $user->role     = 'user
            ';
            $user->save();

            // Redirect ke halaman login setelah registrasi
            return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');

        } catch (\Throwable $th) {
            return back()->withErrors([
                'message' => 'Terjadi kesalahan, silakan coba lagi.',
            ]);
        }
    }
    
    public function tampilRegistrasiPerusahaan()
    {
        return view('auth.registrasi-employer');
    }

    // Memproses data registrasi
    public function submitRegistrasiPerusahaan(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // pastikan form punya field 'password_confirmation'
        ]);

        try {
            // Simpan user baru

            $user = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password); // Enkripsi password
            $user->role     = 'perusahaan';
            $user->save();

            // Redirect ke halaman login setelah registrasi
            return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');

        } catch (\Throwable $th) {
            return back()->withErrors([
                'message' => 'Terjadi kesalahan, silakan coba lagi.',
            ]);
        }
    }
    
public function tampilLogin()
{
    return view('auth.login');
}

public function submitLogin(Request $request)
{
    // Validasi input
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required|string',
    ]);

    // Proses login
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Ambil data user yang login
        $user = Auth::user();

        // Redirect berdasarkan role
        if ($user->role === 'perusahaan') {
            return redirect()->intended('/dashboard-perusahaan');
        } elseif ($user->role === 'user') {
            return redirect()->intended('/beranda');
        }elseif ($user->role === 'admin') {
            return redirect()->intended('/dashboard-admin');
        } else {
            Auth::logout(); // jika role tidak valid
            return redirect('/login')->withErrors([
                'message' => 'Role tidak dikenali. Silakan hubungi admin.',
            ]);
        }
    }

    // Jika login gagal
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}




public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login')->with('success', 'Berhasil logout.');
}
}
