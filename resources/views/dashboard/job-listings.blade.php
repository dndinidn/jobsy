@extends('layout.master')
@section('konten')

    <!-- HOME -->
  <section class="section-hero home-section overlay inner-page bg-image" style="background-image: url('/assets/images/hero_1.jpg');" id="home-section">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="mb-5 text-center">
              <h1 class="text-white font-weight-bold">The Easiest Way To Get Your Dream Job</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, quas fugit ex!</p>
            </div>
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
          {{-- </div>
        </div>
      </div> --}}

      <a href="#next" class="scroll-button smoothscroll">
        <span class=" icon-keyboard_arrow_down"></span>
      </a>
    </section>


    <section class="site-section" id="next">
      <div class="container">


       <ul class="job-listings mb-5" >
  @forelse ($lowongans as $lowongan)
    <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
      <a href="{{ route('jobdetails', ['id' => $lowongan->id])}}"></a>

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
          <strong>{{ $lowongan->user->name }}</strong> {{-- nama pemilik lowongan --}}
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


      </div>
    </section>

    <section class="py-5 bg-image overlay-primary fixed overlay" style="background-image: url('images/hero_1.jpg');">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h2 class="text-white">Looking For A Job?</h2>
            <p class="mb-0 text-white lead">Lorem ipsum dolor sit amet consectetur adipisicing elit tempora adipisci impedit.</p>
          </div>
          <div class="col-md-3 ml-auto">
            <a href="#" class="btn btn-warning btn-block btn-lg">Sign Up</a>
          </div>
        </div>
      </div>
    </section>




@endsection
