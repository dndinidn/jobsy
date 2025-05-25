<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Kategori;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;

class PerusahaanController extends Controller
{
    public function DashboardPerusahaan()
    {
        return view('perusahaan.dashboard-perusahaan');
    }
    public function LihatProfil()
    {
        return view('perusahaan.lihat-profil');
    }

    public function lihatJob()
    {
        // Eager load relasi kategoris
      $lowongans = Lowongan::with('kategoris')
                ->where('user_id', Auth::id()) // hanya ambil lowongan milik user login
                ->get();
        return view('perusahaan.lihat-job', compact('lowongans'));
    }

    public function TambahJob()
    {
        $regions = Region::orderBy('name')->get();
        $kategoris = Kategori::all();
        return view('perusahaan.tambah-job', compact('kategoris','regions'));
    }
public function simpanJob(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'location_id' => 'required|exists:regions,id', // ganti location jadi location_id
        'employment_type' => 'required|in:Full-time,Part-time',
        'description' => 'required',
        'salary' => 'required|string|max:255',
        'kategori_id' => 'required|array',
        'kategori_id.*' => 'exists:kategoris,id',
    ]);

    // Cari nama lokasi dari tabel regions berdasarkan location_id
    $region = Region::find($validated['location_id']);
    $namaLokasi = $region ? $region->name : null;

    // Simpan lowongan
    $lowongan = Lowongan::create([
        'user_id' => Auth::id(),
        'title' => $validated['title'],
        'location' => $namaLokasi, // simpan nama lokasi ke kolom location
        'employment_type' => $validated['employment_type'],
        'description' => $validated['description'],
        'salary' => $validated['salary'],
        'posted_at' => now(),
    ]);

    // Simpan relasi kategori ke tabel pivot
    $lowongan->kategoris()->attach($validated['kategori_id']);

    return redirect()->route('lihat-job')->with('success', 'Lowongan berhasil ditambahkan!');
}
public function editJob($id)
{
      $lowongan = Lowongan::findOrFail($id);
    $regions = Region::orderBy('name')->get();
    $kategoris = Kategori::all(); // jika kategori perlu diedit juga
    return view('perusahaan.edit-job', compact('lowongan', 'kategoris','regions'));
}
public function updateJob(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'location_id' => 'required|exists:regions,id',
        'employment_type' => 'required|in:Full-time,Part-time',
        'description' => 'required',
        'salary' => 'required|string|max:255',
        'kategori_id' => 'required|array',
        'kategori_id.*' => 'exists:kategoris,id',
    ]);

    // Ambil nama lokasi dari ID
    $region = Region::find($request->location_id);
    $namaLokasi = $region ? $region->name : null;

    $lowongan = Lowongan::findOrFail($id);
    $lowongan->update([
        'title' => $request->title,
        'location' => $namaLokasi,
        'employment_type' => $request->employment_type,
        'salary' => $request->salary,
        'description' => $request->description,
    ]);

    // Update kategori
    $lowongan->kategoris()->sync($request->kategori_id);

    return redirect()->route('lihat-job')->with('success', 'Lowongan berhasil diperbarui.');
}
public function hapusJob($id)
{
    $lowongan = Lowongan::findOrFail($id);

    // Hapus relasi ke tabel pivot terlebih dahulu
    $lowongan->kategoris()->detach();

    // Hapus data lowongan
    $lowongan->delete();

    return redirect()->route('lihat-job')->with('success', 'Lowongan berhasil dihapus.');
}



}
