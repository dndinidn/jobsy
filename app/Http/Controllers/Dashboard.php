<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

    public function jobListings(Request $request)
    {
        $query = Lowongan::with('user');

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Ambil lowongan + relasi kategoris
        $lowongans = Lowongan::with(['user', 'kategoris'])->latest()->get();
        return view('dashboard.job-listings', compact('lowongans'));
    }

    public function tampilDetail($id)
    {
        $job = Lowongan::with(['location', 'kategoris', 'user'])->findOrFail($id);
        return view('dashboard.job-detail', compact('job'));
    }

    public function formLamaran($lowongan_id)
    {
        $job = Lowongan::findOrFail($lowongan_id);
        return view('dashboard.lamaran', compact('job'));
    }

    // public function simpanLamaran(Request $request, $lowongan_id)
    // {
    //     $request->validate([
    //         'nama' => 'required',
    //         'telepon' => 'required',
    //         'cv' => 'required|file|mimes:pdf|max:2048',
    //     ]);

    //     DB::beginTransaction();
    //     try {
    //         $cvPath = null;

    //         if ($request->hasFile('cv')) {
    //             $cv = $request->file('cv');
    //             $cvPath = $cv->store('cv_lamaran', 'public');
    //         }

    //         Lamaran::create([
    //             'lowongan_id' => $lowongan_id,
    //             'user_id' => Auth::id(),
    //             'nama' => $request->nama,
    //             'telepon' => $request->telepon,
    //             'cv_path' => $cvPath,
    //         ]);

    //         DB::commit();

    //         return redirect()->route('lihat.lamaran')->with('success', 'Lamaran berhasil dikirim.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         // Hapus file jika sudah sempat terupload
    //         if (isset($cvPath)) {
    //             Storage::disk('public')->delete($cvPath);
    //         }

    //         return back()->withErrors(['message' => 'Gagal mengirim lamaran: ' . $e->getMessage()]);
    //     }
    // }
public function simpanLamaran(Request $request, $lowongan_id)
{
    $request->validate([
        'nama' => 'required',
        'telepon' => 'required',
        'cv' => 'required|file|mimes:pdf|max:2048',
    ]);

    DB::beginTransaction();
    try {
        $cvPath = null;

        if ($request->hasFile('cv')) {
            $cv = $request->file('cv');
            $cvPath = $cv->store('cv_lamaran', 'public');
        }

        $lowongan = Lowongan::lockForUpdate()->findOrFail($lowongan_id);

        // ✅ Tambahkan pengecekan dan decrement kuota
        if ($lowongan->jumlah_orang <= 0) {
            throw new \Exception('Kuota lowongan sudah penuh.');
        }

        // Cek jika user sudah pernah melamar
        $sudahMelamar = Lamaran::where('user_id', Auth::id())
            ->where('lowongan_id', $lowongan->id)
            ->exists();

        if ($sudahMelamar) {
            throw new \Exception('Anda sudah melamar ke lowongan ini.');
        }

        Lamaran::create([
            'lowongan_id' => $lowongan_id,
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'cv_path' => $cvPath,
            'status' => 'menunggu',
        ]);

        $lowongan->decrement('jumlah_orang');

        DB::commit();

        return redirect()->route('lihat.lamaran')->with('success', 'Lamaran berhasil dikirim.');
    } catch (\Exception $e) {
        DB::rollBack();

        if (isset($cvPath)) {
            Storage::disk('public')->delete($cvPath);
        }

        return back()->withErrors(['message' => 'Gagal mengirim lamaran: ' . $e->getMessage()]);
    }
}

    public function tampilSemuaLamaran()
    {
        $lamarans = Lamaran::where('user_id', Auth::id())->latest()->get();
        return view('dashboard.detail-lamaran', compact('lamarans'));
    }

    public function DashboardPerusahaan()
    {
        $userId = Auth::id();

        // Ambil semua ID lowongan milik perusahaan login
        $lowonganIds = Lowongan::where('user_id', $userId)->pluck('id');

        // Hitung jumlah lamaran yang masuk ke lowongan tersebut
        $totalPelamar = Lamaran::whereIn('lowongan_id', $lowonganIds)->count();

        return view('perusahaan.dashboard-perusahaan', compact('totalPelamar'));

    }

public function lamarJob(Request $request)
{
    $request->validate([
        'lowongan_id' => 'required|exists:lowongans,id',
    ]);

    try {
        DB::transaction(function () use ($request) {
            $lowongan = Lowongan::lockForUpdate()->findOrFail($request->lowongan_id);

            // Cek kuota
            if ($lowongan->jumlah_orang <= 0) {
                abort(400, 'Kuota lowongan sudah penuh.');
            }

            // Cek apakah user sudah melamar
            $sudahMelamar = Lamaran::where('user_id', Auth::id())
                ->where('lowongan_id', $lowongan->id)
                ->exists();

            if ($sudahMelamar) {
                abort(400, 'Anda sudah melamar ke lowongan ini.');
            }

            // Simpan lamaran
            Lamaran::create([
                'user_id' => Auth::id(),
                'lowongan_id' => $lowongan->id,
                'status' => 'menunggu',
            ]);

            // Kurangi kuota
            $lowongan->decrement('jumlah_orang');
        });

        return redirect()->back()->with('success', 'Lamaran berhasil dikirim!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal melamar: ' . $e->getMessage());
    }
}

}
