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

            Lamaran::create([
                'lowongan_id' => $lowongan_id,
                'user_id' => Auth::id(),
                'nama' => $request->nama,
                'telepon' => $request->telepon,
                'cv_path' => $cvPath,
            ]);

            DB::commit();

            return redirect()->route('lihat.lamaran')->with('success', 'Lamaran berhasil dikirim.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Hapus file jika sudah sempat terupload
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
}
