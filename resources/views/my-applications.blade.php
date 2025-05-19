@extends('master')

@section('konten')
<section class="site-section">
  <div class="container">
    <div class="row mb-5 justify-content-center">
      <div class="col-md-7 text-center">
        <h2 class="section-title mb-2">Lamaran Saya</h2>
      </div>
    </div>

    <ul class="job-listings mb-5">
      {{-- Contoh Lamaran Manual --}}
      <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
        <div class="job-listing-logo">
          <img src="/assets/images/job_logo_1.jpg" alt="Logo Perusahaan" class="img-fluid">
        </div>
        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
          <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
            <h2>Frontend Developer</h2>
            <strong>Tokopedia</strong>
          </div>
          <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
            <span class="icon-room"></span> Jakarta
          </div>
          <div class="job-listing-meta">
            <span class="badge badge-warning">Pending</span>
          </div>
        </div>
      </li>

      <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
        <div class="job-listing-logo">
          <img src="/assets/images/job_logo_2.jpg" alt="Logo Perusahaan" class="img-fluid">
        </div>
        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
          <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
            <h2>UI/UX Designer</h2>
            <strong>Gojek</strong>
          </div>
          <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
            <span class="icon-room"></span> Bandung
          </div>
          <div class="job-listing-meta">
            <span class="badge badge-success">Diterima</span>
          </div>
        </div>
      </li>

      <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
        <div class="job-listing-logo">
          <img src="/assets/images/job_logo_3.jpg" alt="Logo Perusahaan" class="img-fluid">
        </div>
        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
          <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
            <h2>Backend Engineer</h2>
            <strong>Ruangguru</strong>
          </div>
          <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
            <span class="icon-room"></span> Yogyakarta
          </div>
          <div class="job-listing-meta">
            <span class="badge badge-danger">Ditolak</span>
          </div>
        </div>
      </li>

    </ul>

  </div>
</section>
@endsection
