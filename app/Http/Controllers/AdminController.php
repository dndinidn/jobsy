<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{

     public function dashboardAdmin()
{
    return view('admin.dashboard',[
         'totalPerusahaan' => User::where('role', 'perusahaan')->count(),
         'totalPelamar' => User::where('role', 'user')->count(),
         'totalKategori' => Kategori::count(),
    ]);

}
public function lihatKategori(){
    $kategori= Kategori::all();
    return view('admin.lihat-kategori',compact('kategori'));
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

        // Hapus user
        $jobseeker->delete();

        // Redirect kembali ke daftar dengan pesan sukses
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
            if ( $employer->role !== 'perusahaan') {
            return redirect()->route('lihat.employer')->with('error', 'User bukan  employer.');
        }

        // Hapus user
        $employer->delete();

        // Redirect kembali ke daftar dengan pesan sukses
        return redirect()->route('lihat.employer')->with('success', 'Akun employer berhasil dihapus.');
    }
// public function edit($id)
//     {
//         $kategori = Kategori::findOrFail($id);
//         return view('admin.kategori.edit', compact('kategori'));
//     }

//     public function updateKategori(Request $request, $id)
//     {
//         $request->validate([
//             'nama_kategori' => 'required|string|max:255',
//         ]);

//         $kategori = Kategori::findOrFail($id);
//         $kategori->nama_kategori = $request->nama_kategori;
//         $kategori->save();

//         return redirect()->route('lihat-kategori')->with('success', 'Kategori berhasil diperbarui.');
//     }

//     public function destroy($id)
//     {
//         $kategori = Kategori::findOrFail($id);
//         $kategori->delete();

//         return redirect()->route('lihat-kategori')->with('success', 'Kategori berhasil dihapus.');
//     }
     public function TambahKategori()
    {
        // $matakuliah = Courses::all(); // Ambil semua data dari tabel post
        $kategori = Kategori::all(); // Ambil semua mata kuliah dari tabel courses
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

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('lihat-kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }
     public function hapusKategori($id)
    {
        $kategori = Kategori::find($id);
        if (!$kategori) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }
        $kategori->delete();
        return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus.');
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

    $kategori = Kategori::findOrFail($id);
    // $kategori->nama_kategori = $request->nama_kategori;
    $kategori->update([
        'nama_kategori'=>$request->nama_kategori
    ]);

    return redirect()->route('lihat-kategori')->with('success', 'Kategori berhasil diperbarui.');
}


    //
}
