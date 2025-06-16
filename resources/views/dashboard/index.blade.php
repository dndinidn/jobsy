@extends('layout.master')
@section('konten')

<!-- HOME -->
<section class="home-section section-hero overlay bg-image" style="background-image: url('/assets/images/hero_1.jpg');" id="home-section">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-12">
        <div class="mb-5 text-center">
  <h1 class="text-white font-weight-bold">Find Your Dream Job</h1>
  <p>Explore thousands of job opportunities from top companies and take the next step in your career journey with confidence.</p>
</div>


        <!-- Form Pencarian -->
     <form method="get" action="{{ route('beranda') }}" class="search-jobs-form">
  <div class="row mb-5">
    <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-4 mb-lg-0">
      <input type="text" name="title" class="form-control form-control-lg" placeholder="Job title" value="{{ request('title') }}">
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
      <button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search">
        <span class="icon-search icon mr-2"></span>Search Job
      </button>
    </div>
  </div>
</form>

        <!-- End Form -->
      </div>
    </div>
  </div>

  <a href="#next" class="scroll-button smoothscroll">
    <span class=" icon-keyboard_arrow_down"></span>
  </a>
</section>

<!-- JOB LIST -->
<section class="site-section">
  <div class="container">
    <div class="row mb-5 justify-content-center">
      <div class="col-md-7 text-center">
        <h2 class="section-title mb-2">Job Listed</h2>
      </div>
    </div>

    <ul class="job-listings mb-5">
      @forelse ($lowongans as $lowongan)
        <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
          <a href="#"></a>
         <div class="job-listing-logo">
    <img src="{{
        $lowongan->user && $lowongan->user->profile && $lowongan->user->profile->profile_picture
            ? asset('storage/' . $lowongan->user->profile->profile_picture)
            : asset('assets-admin/img/undraw_profile_1.svg')
        }}"
        alt="Foto Profil"
        class="img-fluid"
        style="max-width: 150px; border-radius: 0;"> {{-- border-radius 0 agar tidak bundar --}}
</div>
          <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
            <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
              <h2>{{ $lowongan->title }}</h2>
              <strong>{{ $lowongan->user->name }}</strong>
            </div>
            <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
              <span class="icon-room"></span> {{ $lowongan->location }}
            </div>
            <div class="job-listing-meta">
              <span class="badge {{ $lowongan->employment_type === 'Part Time' ? 'badge-danger' : 'badge-success' }}">
                {{ $lowongan->employment_type }}
              </span>
            </div>
          </div>
        </li>
      @empty
        <p class="text-center">Belum ada lowongan tersedia.</p>
      @endforelse
    </ul>

    <div class="text-center">
      <a href="{{ route('job.listings') }}" class="btn btn-primary">More</a>
    </div>
  </div>
</section>

<section class="py-5 bg-image overlay-primary fixed overlay" style="background-image: url('images/hero_1.jpg');">
  <div class="container">
  <div class="row align-items-center">
  <div class="col-md-8">
    <h2 class="text-white">Looking For A Job?</h2>
    <p class="mb-0 text-white lead">
      Discover thousands of job opportunities tailored to your skills and interests. Connect with top companies and take the next step in your career today!
    </p>
  </div>
</div>


    </div>
  </div>
</section>

@endsection
