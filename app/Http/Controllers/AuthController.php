<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function tampilRegistrasiUser()
    {
        return view('auth.registrasi-jobseeker');
    }

    public function submitRegistrasiUser(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        DB::beginTransaction();
        try {
            $user = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->role     = 'user';
            $user->save();

            DB::commit();

            return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors([
                'message' => 'Terjadi kesalahan, silakan coba lagi.',
            ]);
        }
    }

    public function tampilRegistrasiPerusahaan()
    {
        return view('auth.registrasi-employer');
    }

    public function submitRegistrasiPerusahaan(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        DB::beginTransaction();
        try {
            $user = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->role     = 'perusahaan';
            $user->save();

            DB::commit();

            return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
        } catch (\Throwable $th) {
            DB::rollBack();
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
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'perusahaan') {
                return redirect()->intended('/dashboard-perusahaan');
            } elseif ($user->role === 'user') {
                return redirect()->intended('/');
            } elseif ($user->role === 'admin') {
                return redirect()->intended('/dashboard-admin');
            } else {
                Auth::logout();
                return redirect('/login')->withErrors([
                    'message' => 'Role tidak dikenali. Silakan hubungi admin.',
                ]);
            }
        }

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
