<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboardAdmin()
    {
        return view('admin.dashboard', [
            'totalPerusahaan' => User::where('role', 'perusahaan')->count(),
            'totalPelamar' => User::where('role', 'user')->count(),
            'totalKategori' => Kategori::count(),
        ]);
    }

    public function lihatKategori()
    {
        $kategori = Kategori::all();
        return view('admin.lihat-kategori', compact('kategori'));
    }

    public function LihatJobSeeker()
    {
        $jobseekers = User::where('role', 'user')->paginate(10);
        return view('admin.lihat-akun-jobseeker', compact('jobseekers'));
    }

    public function hapusJobseeker($id)
    {
        $jobseeker = User::findOrFail($id);
        if ($jobseeker->role !== 'user') {
            return redirect()->route('lihat.jobseeker')->with('error', 'User bukan jobseeker.');
        }

        $jobseeker->delete();
        return redirect()->route('lihat.jobseeker')->with('success', 'Akun jobseeker berhasil dihapus.');
    }

    public function LihatEmployer()
    {
        $employers = User::where('role', 'perusahaan')->paginate(10);
        return view('admin.lihat-akun-employer', compact('employers'));
    }

    public function hapusEmployer($id)
    {
        $employer = User::findOrFail($id);
        if ($employer->role !== 'perusahaan') {
            return redirect()->route('lihat.employer')->with('error', 'User bukan employer.');
        }

        $employer->delete();
        return redirect()->route('lihat.employer')->with('success', 'Akun employer berhasil dihapus.');
    }

    public function TambahKategori()
    {
        $kategori = Kategori::all();
        return view('admin.tambah-kategori', compact('kategori'));
    }

    public function simpanKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|unique:kategoris,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada, silakan masukkan nama yang berbeda.',
        ]);

        DB::beginTransaction();
        try {
            Kategori::create([
                'nama_kategori' => $request->nama_kategori,
            ]);

            DB::commit();
            return redirect()->route('lihat-kategori')->with('success', 'Kategori berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan kategori: ' . $e->getMessage());
        }
    }

    public function hapusKategori($id)
    {
        DB::beginTransaction();
        try {
            $kategori = Kategori::find($id);
            if (!$kategori) {
                return redirect()->back()->with('error', 'Data kategori tidak ditemukan.');
            }

            $kategori->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kategori: ' . $e->getMessage());
        }
    }

    public function editKategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.edit-kategori', compact('kategori'));
    }
    

    public function updateKategori(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $id,
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada, silakan masukkan nama yang berbeda.',
        ]);

        DB::beginTransaction();
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->update([
                'nama_kategori' => $request->nama_kategori
            ]);

            DB::commit();
            return redirect()->route('lihat-kategori')->with('success', 'Kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui kategori: ' . $e->getMessage());
        }
    }
}
