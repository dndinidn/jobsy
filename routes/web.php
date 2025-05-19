<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;

// Halaman utama / welcome
Route::get('/', function () {
    return view('welcome');
});

// Halaman umum tanpa login
Route::get('/beranda', [Dashboard::class, 'index'])->name('beranda');
Route::get('/job-listings', [Dashboard::class, 'jobListings'])->name('joblistings');
Route::get('/job-detail', [Dashboard::class, 'jobDetails'])->name('jobdetails');
Route::get('/job-single', [Dashboard::class, 'jobSingle'])->middleware('auth')->name('jobSingle');
Route::get('/my-applications', [Dashboard::class, 'myApplications'])->middleware(['auth', 'role:user'])->name('myApplications');

// Registrasi
Route::get('registrasi-jobseeker', [AuthController::class, 'tampilRegistrasi'])->name('registrasi.jobseeker');
Route::post('/registrasi/user', [AuthController::class, 'submitRegistrasi'])->name('registrasi.user');

Route::get('registrasi-employer', [AuthController::class, 'tampilRegistrasiPerusahaan'])->name('registrasi.employer');
Route::post('/registrasi/perusahaan', [AuthController::class, 'submitRegistrasiPerusahaan'])->name('registrasi.perusahaan');

// Login & Logout
Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/login', [AuthController::class, 'submitLogin'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard yang hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {
    Route::get('/job-listings', [Dashboard::class, 'jobListings'])->name('dashboard');
    // Kalau kamu mau bikin route khusus untuk dashboard perusahaan dan user, bisa ditambah di sini
});

// Contoh middleware proteksi untuk job-detail supaya harus login dulu
// Route::get('/job-detail', [Dashboard::class, 'jobDetails'])->middleware('auth')->name('jobdetails.protected');

// admin
 Route::get('/dashboard-admin', [AdminController::class, 'dashboardAdmin'])->name('admin.dashboard');
 Route::get('/admin/lihat-kategori', [AdminController::class, 'lihatKategori'])->name('lihat-kategori');
// Route::resource('kategori', App\Http\Controllers\AdminController::class);
// 
Route::get('/admin/tambah-kategori', [AdminController::class, 'TambahKategori'])->name('tambah-kategori');
Route::post('/simpan-kategori', [AdminController::class, 'simpanKategori'])->name('simpan-kategori');
 Route::get('admin/edit-kategori/{id}', [AdminController::class, 'editKategori'])->name('edit-kategori');
 Route::delete('/hapus-kategori/{id}', [AdminController::class, 'hapusKategori'])->name('hapus-kategori');
Route::put('/update-kategori/{id}', [AdminController::class, 'updateKategori'])->name('update-kategori');