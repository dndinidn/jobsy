<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\ProfileController;


Route::get('/', [Dashboard::class, 'index'])->name('beranda');

// Registrasi
Route::get('registrasi-jobseeker', [AuthController::class, 'tampilRegistrasiUser'])->name('registrasi.jobseeker');
Route::post('/registrasi/user', [AuthController::class, 'submitRegistrasiUser'])->name('registrasi.user');
Route::get('registrasi-employer', [AuthController::class, 'tampilRegistrasiPerusahaan'])->name('registrasi.employer');
Route::post('/registrasi/perusahaan', [AuthController::class, 'submitRegistrasiPerusahaan'])->name('registrasi.perusahaan');

// Login & Logout
Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/login', [AuthController::class, 'submitLogin'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//hak akses login sebagai user atau jobseeker
Route::middleware('auth', 'user')->group(function () {
Route::get('/post-job', [Dashboard::class, 'PostJob'])->name('post');
Route::get('/lihat-profil-jobseeker', [ProfileController::class, 'LihatProfilJobseeker'])->name('lihat.profil.jobseeker');
Route::get('/profil/edit-jobseeker', [ProfileController::class, 'editProfilJobseeker'])->name('jobseeker.edit.profil');
Route::put('/profil/update-jobseeker', [ProfileController::class, 'updateProfilJobseeker'])->name('profile.update.jobseeker');
Route::get('/job-listings', [Dashboard::class, 'jobListings'])->name('job.listings');
Route::get('/job-detail/{id}', [Dashboard::class, 'tampilDetail'])->name('jobdetails');
Route::get('/job-single', [Dashboard::class, 'jobSingle'])->middleware('auth')->name('jobSingle');
Route::get('/my-applications', [Dashboard::class, 'myApplications'])->name('myApplications');
Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
Route::get('/lamaran/{lowongan_id}', [Dashboard::class, 'formLamaran'])->name('lamaran.create');
Route::post('/simpan-lamaran/{lowongan_id}', [Dashboard::class, 'simpanLamaran'])->name('lamaran.store');
Route::get('/lamaran-saya', [Dashboard::class, 'tampilSemuaLamaran'])->name('lihat.lamaran');
});

//hak akses login sebagai admin
Route::middleware('auth', 'admin')->group(function () {
Route::get('/dashboard-admin', [AdminController::class, 'dashboardAdmin'])->name('admin.dashboard');
Route::get('/lihat-profil-admin', [ProfileController::class, 'LihatProfilAdmin'])->name('lihat.profil.admin');
Route::get('/admin/profil/edit', [ProfileController::class, 'editProfilAdmin'])->name('admin.edit.profil');
Route::put('/admin/profil/update', [ProfileController::class, 'updateProfilAdmin'])->name('admin.profile.update');
Route::get('/admin/lihat-kategori', [AdminController::class, 'lihatKategori'])->name('lihat-kategori');
Route::get('/admin/lihat-jobseeker', [AdminController::class, 'lihatJobSeeker'])->name('lihat.jobseeker');
Route::delete('/jobseeker/{id}', [AdminController::class, 'hapusJobSeeker'])->name('jobseeker.destroy');
Route::get('/admin/lihat-employer', [AdminController::class, 'lihatEmployer'])->name('lihat.employer');
Route::delete('/employer/{id}', [AdminController::class, 'hapusEmployer'])->name('employer.destroy');
Route::get('/admin/tambah-kategori', [AdminController::class, 'TambahKategori'])->name('tambah-kategori');
Route::post('/simpan-kategori', [AdminController::class, 'simpanKategori'])->name('simpan-kategori');
Route::get('admin/edit-kategori/{id}', [AdminController::class, 'editKategori'])->name('edit-kategori');
Route::delete('/hapus-kategori/{id}', [AdminController::class, 'hapusKategori'])->name('hapus-kategori');
Route::put('/update-kategori/{id}', [AdminController::class, 'updateKategori'])->name('update-kategori');
Route::get('/dashboard-admin', [AdminController::class, 'dashboardAdmin'])->name('admin.dashboard');
Route::get('/admin/lihat-kategori', [AdminController::class, 'lihatKategori'])->name('lihat-kategori');
Route::get('/admin/tambah-kategori', [AdminController::class, 'TambahKategori'])->name('tambah-kategori');
Route::post('/simpan-kategori', [AdminController::class, 'simpanKategori'])->name('simpan-kategori');
Route::get('admin/edit-kategori/{id}', [AdminController::class, 'editKategori'])->name('edit-kategori');
Route::delete('/hapus-kategori/{id}', [AdminController::class, 'hapusKategori'])->name('hapus-kategori');
Route::put('/update-kategori/{id}', [AdminController::class, 'updateKategori'])->name('update-kategori');
});

//hak akses login sebagai perusahaan
Route::middleware('auth', 'perusahaan')->group(function () {
Route::get('/dashboard-perusahaan', [PerusahaanController::class, 'DashboardPerusahaan'])->name('perusahaan.dashboard');
Route::get('/lihat-profil-perusahaan', [ProfileController::class, 'LihatProfilPerusahaan'])->name('lihat.profil.perusahaan');
Route::get('/profil/edit', [ProfileController::class, 'editProfilPerusahaan'])->name('perusahaan.edit.profil');
Route::put('/profil/update', [ProfileController::class, 'updateProfilPerusahaan'])->name('profile.update');
Route::get('/perusahaan/tambah-job', [PerusahaanController::class, 'TambahJob'])->name('tambah-job');
Route::post('/simpan-job', [PerusahaanController::class, 'simpanJob'])->name('simpan-job');
Route::get('/perusahaan/lihat-job', [PerusahaanController::class, 'lihatJob'])->name('lihat-job');
Route::get('admin/edit-job/{id}', [PerusahaanController::class, 'editJob'])->name('edit-job');
Route::delete('/hapus-job/{id}', [PerusahaanController::class, 'hapusJob'])->name('hapus-job');
Route::put('/update-job/{id}', [PerusahaanController::class, 'updateJob'])->name('update-job');
Route::put('/application/update/{id}', [PerusahaanController::class, 'updateStatus'])->name('application.update.status');
Route::get('/perusahaan-status-job', [PerusahaanController::class, 'statusJob'])->name('perusahaan.status-job');
Route::put('/perusahaan/lamaran/{id}/status', [PerusahaanController::class, 'updateStatus'])->name('application.update.status');
});
