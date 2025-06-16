<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function LihatProfilAdmin()
{
    $user = Auth::user();
    return view('admin.lihat-profil', compact('user'));
}

public function editProfilAdmin()
{
    $user = Auth::user();
    return view('admin.edit-profil', compact('user'));
}

public function updateProfilAdmin(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('profile_pictures', $filename, 'public');

        if ($user->profile) {
            // Hapus file lama jika ada
            if ($user->profile->profile_picture && Storage::disk('public')->exists($user->profile->profile_picture)) {
                Storage::disk('public')->delete($user->profile->profile_picture);
            }

            $user->profile->update([
                'profile_picture' => $path,
            ]);
        } else {
            $user->profile()->create([
                'profile_picture' => $path,
            ]);
        }
    }

    return redirect()->route('lihat.profil.admin')->with('success', 'Profil berhasil diperbarui!');
}

public function LihatProfilJobseeker()
{
    $user = Auth::user();
    return view('dashboard.lihat-profil', compact('user'));
}

public function editProfilJobseeker()
{
    $user = Auth::user();
    return view('dashboard.edit-profil', compact('user'));
}

public function updateProfilJobseeker(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('profile_pictures', $filename, 'public');

        if ($user->profile) {
            // Hapus file lama jika ada
            if ($user->profile->profile_picture && Storage::disk('public')->exists($user->profile->profile_picture)) {
                Storage::disk('public')->delete($user->profile->profile_picture);
            }

            $user->profile->update([
                'profile_picture' => $path,
            ]);
        } else {
            $user->profile()->create([
                'profile_picture' => $path,
            ]);
        }
    }

    return redirect()->route('lihat.profil.jobseeker')->with('success', 'Profil berhasil diperbarui!');
}


    public function LihatProfilPerusahaan()
    {
        $user = Auth::user();
    return view('perusahaan.lihat-profil', compact('user'));
}

    public function editProfilPerusahaan()
{

    $user = Auth::user();

    return view('perusahaan.edit-profil', compact('user'));
}
public function updateProfilPerusahaan(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('profile_pictures', $filename, 'public');
        if ($user->profile) {
            // Hapus file lama jika ada
            if ($user->profile->profile_picture && Storage::disk('public')->exists($user->profile->profile_picture)) {
                Storage::disk('public')->delete($user->profile->profile_picture);
            }

            $user->profile->update([
                'profile_picture' => $path,
            ]);
        } else {

            $user->profile()->create([
                'profile_picture' => $path,
            ]);
        }
    }

    return redirect()->route('lihat.profil.perusahaan')->with('success', 'Profil berhasil diperbarui!');
}
}
