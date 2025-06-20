<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Region;
use App\Models\Lamaran;
use App\Models\Kategori;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerusahaanController extends Controller
{
    public function DashboardPerusahaan()
    {
        $userId = Auth::id();
        $lowonganIds = Lowongan::where('user_id', $userId)->pluck('id');
        $totalPelamar = Lamaran::whereIn('lowongan_id', $lowonganIds)->count();

        return view('perusahaan.dashboard-perusahaan', compact('totalPelamar'));
    }

    public function lihatJob()
    {
        $lowongans = Lowongan::with('kategoris')
            ->where('user_id', Auth::id())
            ->get();

        return view('perusahaan.lihat-job', compact('lowongans'));
    }

    public function TambahJob()
    {
        $regions = Region::orderBy('name')->get();
        $kategoris = Kategori::all();
        return view('perusahaan.tambah-job', compact('kategoris', 'regions'));
    }

    public function simpanJob(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location_id' => 'required|exists:regions,id',
            'employment_type' => 'required|in:Full-time,Part-time',
            'description' => 'required',
            'salary' => 'required|string|max:255',
            'kategori_id' => 'required|array',
            'kategori_id.*' => 'exists:kategoris,id',
        ]);

        DB::transaction(function () use ($validated) {
            $region = Region::find($validated['location_id']);
            $namaLokasi = $region ? $region->name : null;

            $lowongan = Lowongan::create([
                'user_id' => Auth::id(),
                'title' => $validated['title'],
                'location' => $namaLokasi,
                'employment_type' => $validated['employment_type'],
                'description' => $validated['description'],
                'salary' => $validated['salary'],
                'posted_at' => now(),
            ]);

            $lowongan->kategoris()->attach($validated['kategori_id']);
        });

        return redirect()->route('lihat-job')->with('success', 'Lowongan berhasil ditambahkan!');
    }

    public function editJob($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $regions = Region::orderBy('name')->get();
        $kategoris = Kategori::all();
        return view('perusahaan.edit-job', compact('lowongan', 'kategoris', 'regions'));
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

        DB::beginTransaction();
        try {
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

            $lowongan->kategoris()->sync($request->kategori_id);

            DB::commit();
            return redirect()->route('lihat-job')->with('success', 'Lowongan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui lowongan: ' . $e->getMessage()]);
        }
    }

    public function hapusJob($id)
    {
        DB::beginTransaction();
        try {
            $lowongan = Lowongan::findOrFail($id);
            $lowongan->kategoris()->detach();
            $lowongan->delete();

            DB::commit();
            return redirect()->route('lihat-job')->with('success', 'Lowongan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('lihat-job')->with('error', 'Gagal menghapus lowongan: ' . $e->getMessage());
        }
    }

    public function statusJob()
    {
        $userId = Auth::id();
        $lowonganIds = Lowongan::where('user_id', $userId)->pluck('id');

        $applications = Lamaran::whereIn('lowongan_id', $lowonganIds)
            ->with(['lowongan'])
            ->latest()
            ->get();

        return view('perusahaan.status-job', compact('applications'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak',
        ]);

        $lamaran = Lamaran::findOrFail($id);

        if ($lamaran->lowongan->user_id != Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah status lamaran ini.');
        }

        $lamaran->status = $request->status;
        $lamaran->save();

        return redirect()->back()->with('success', 'Status lamaran berhasil diperbarui.');
    }
}
