<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function LihatProfilAdmin()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('admin.lihat-profil', compact('user'));
    }

    public function editProfilAdmin()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('admin.edit-profil', compact('user'));
    }

    public function updateProfilAdmin(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('profile_pictures', $filename, 'public');

                /** @var Profile|null $profile */
                $profile = $user->profile;

                if ($profile) {
                    if ($profile->profile_picture && Storage::disk('public')->exists($profile->profile_picture)) {
                        Storage::disk('public')->delete($profile->profile_picture);
                    }
                    $profile->update(['profile_picture' => $path]);
                } else {
                    $user->profile()->create(['profile_picture' => $path]);
                }
            }

            DB::commit();
            return redirect()->route('lihat.profil.admin')->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['message' => 'Gagal memperbarui profil: ' . $e->getMessage()]);
        }
    }

    public function LihatProfilJobseeker()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('dashboard.lihat-profil', compact('user'));
    }

    public function editProfilJobseeker()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('dashboard.edit-profil', compact('user'));
    }

    public function updateProfilJobseeker(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('profile_pictures', $filename, 'public');

                /** @var Profile|null $profile */
                $profile = $user->profile;

                if ($profile) {
                    if ($profile->profile_picture && Storage::disk('public')->exists($profile->profile_picture)) {
                        Storage::disk('public')->delete($profile->profile_picture);
                    }
                    $profile->update(['profile_picture' => $path]);
                } else {
                    $user->profile()->create(['profile_picture' => $path]);
                }
            }

            DB::commit();
            return redirect()->route('lihat.profil.jobseeker')->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['message' => 'Gagal memperbarui profil: ' . $e->getMessage()]);
        }
    }

    public function LihatProfilPerusahaan()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('perusahaan.lihat-profil', compact('user'));
    }

    public function editProfilPerusahaan()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('perusahaan.edit-profil', compact('user'));
    }

    public function updateProfilPerusahaan(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('profile_pictures', $filename, 'public');

                /** @var Profile|null $profile */
                $profile = $user->profile;

                if ($profile) {
                    if ($profile->profile_picture && Storage::disk('public')->exists($profile->profile_picture)) {
                        Storage::disk('public')->delete($profile->profile_picture);
                    }
                    $profile->update(['profile_picture' => $path]);
                } else {
                    $user->profile()->create(['profile_picture' => $path]);
                }
            }

            DB::commit();
            return redirect()->route('lihat.profil.perusahaan')->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['message' => 'Gagal memperbarui profil: ' . $e->getMessage()]);
        }
    }
}
