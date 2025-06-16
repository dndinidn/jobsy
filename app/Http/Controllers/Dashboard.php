<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lowongan;
use App\Models\Region;
use App\Models\Application;
use App\Models\Lamaran;

class Dashboard extends Controller
{
public function index(Request $request)
{
    $query = Lowongan::with('user');

    if ($request->filled('title')) {
        $query->where('title', 'like', '%' . $request->title . '%');
    }

    $lowongans = $query->latest()->get();

    return view('dashboard.index', compact('lowongans'));
}






    public function jobSingle()
{
    return view('dashboard.job-single');
}

//     public function Profil()
// {
//     $user=Auth::user();
//     return view('dashboard.profil',compact('user'));
// }
 public function jobListings(Request $request)
{
     $query = Lowongan::with('user');

    if ($request->filled('title')) {
        $query->where('title', 'like', '%' . $request->title . '%');
    }

    $lowongans = $query->latest()->get();

    $lowongans = Lowongan::with(['user', 'kategoris'])->latest()->get();
    return view('dashboard.job-listings', compact('lowongans'));
}
public function tampilDetail($id)
{
      $job = Lowongan::with(['location', 'kategoris', 'user'])->findOrFail($id);
        return view('dashboard.job-detail', compact('job'));
}
// public function tampilDetail()
// {

//         return view('job-detail');
// }

// Menampilkan form lamaran
public function formLamaran($lowongan_id)
{
    $job = Lowongan::findOrFail($lowongan_id);
    return view('dashboard.lamaran', compact('job'));
}
// public function tampilDetailLamaran()
// {
//     $lamarans = Lamaran::where('email', Auth::user()->email)->latest()->get();
//     return view('dashboard.detail-lamaran', compact('lamarans'));
// }

// Menyimpan data lamaran
public function simpanLamaran(Request $request, $lowongan_id)
{
    $request->validate([
        'nama' => 'required',
        'telepon' => 'required',
        'cv' => 'required|file|mimes:pdf|max:2048',
    ]);

    if ($request->hasFile('cv')) {
        $cv = $request->file('cv');
        $cvPath = $cv->store('cv_lamaran', 'public');
    }

$lamaran = Lamaran::create([
    'lowongan_id' => $lowongan_id,
    'user_id' => Auth::id(),
    'nama' => $request->nama,
    'telepon' => $request->telepon,
    'cv_path' => $cvPath ?? null,
]);


    return redirect()->route('lihat.lamaran')
                     ->with('success', 'Lamaran berhasil dikirim.');
}

public function tampilSemuaLamaran()
{
    $lamarans = Lamaran::where('user_id', Auth::id())->latest()->get();
    return view('dashboard.detail-lamaran', compact('lamarans'));
}




}
