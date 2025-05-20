<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function index()
{
    return view('index');
}
   
    public function jobListings()
{
    return view('job-listings');
}
    public function jobDetails()
{
    return view('job-detail');
}
   
    public function jobSingle()
{
    return view('job-single');
}
    public function myApplications()
{
    return view('my-applications');
}
    public function Profil()
{
    $user=Auth::user();
    return view('profil',compact('user'));
}
 public function PostJob()
    {
        // $matakuliah = Courses::all(); // Ambil semua data dari tabel post
        $kategori = Kategori::all(); // Ambil semua mata kuliah dari tabel courses
        return view('admin.tambah-kategori', compact('kategori'));
    }
    
}
