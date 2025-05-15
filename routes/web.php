<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\MainController;
use Illuminate\Container\Attributes\Auth;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/beranda', [Dashboard::class, 'index'])->name('beranda');
Route::get('/job-listings', [Dashboard::class, 'jobListings'])->name('joblistings');
Route::get('/job-detail', [Dashboard::class, 'jobDetails'])->name('jobdetails');
Route::get('/login', [AuthController::class, 'Login'])->name('login');
Route::get('/register', [AuthController::class, 'Register'])->name('register');


