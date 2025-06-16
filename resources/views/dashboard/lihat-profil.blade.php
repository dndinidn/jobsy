@extends('layout.master')
@section('konten')

<!-- HOME -->
<section class="section-hero home-section overlay inner-page bg-image" style="background-image: url('/assets/images/bg_profile.jpg');" id="home-section">

  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-12">
        <div class="mb-5 text-center">
          <h1 class="text-white font-weight-bold">Profil Saya</h1>
        </div>
      </div>
    </div>
  </div>
  <a href="#next" class="scroll-button smoothscroll">
    <span class=" icon-keyboard_arrow_down"></span>
  </a>
</section>

<!-- Bagian Lihat Profil -->
<section class="site-section" id="next" style="background-color: rgb(255, 255, 255); padding-top: 40px; padding-bottom: 40px;">
  <div class="container">
    <div class="card mx-auto" style="max-width: 400px; background-color: white;">
      <div class="card-body text-center">
        <img src="{{ auth()->user()->profile && auth()->user()->profile->profile_picture
          ? asset('storage/' . auth()->user()->profile->profile_picture)
          : asset('assets-admin/img/undraw_profile_1.svg') }}"
          alt="Foto Profil"
          class="img-fluid rounded-circle mb-3"
          style="width: 150px; height: 150px;">
        <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>

        <!-- Tombol Edit Profil -->
        <a href="{{ route('jobseeker.edit.profil') }}" class="btn btn-primary mt-3">Edit Profile</a>
      </div>
    </div>
  </div>
</section>

@endsection
