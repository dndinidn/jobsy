<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function postJob()
{
    return view('post-job');
}
    public function jobSingle()
{
    return view('job-single');
}
    public function myApplications()
{
    return view('my-applications');
}
    
}
