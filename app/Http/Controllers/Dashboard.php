<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lowongan;
class Dashboard extends Controller
{
    public function index()
{
    return view('index');
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
 public function jobListings()
{
    $lowongans = Lowongan::with(['user', 'kategoris'])->latest()->get();
    return view('job-listings', compact('lowongans'));
}

    
}
