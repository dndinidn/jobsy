@extends('master')
@section('konten')
<section class="site-section" style="background-color: rgb(234, 234, 234);">
  <div class="container">
    <h2 class="mb-4">Profil Saya</h2>

    <!-- Tampilkan data profil -->
    <div class="card mb-4" style="background-color: white;">
      <div class="card-body">
        <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
      </div>
    </div>

  </div>
</section>
@endsection
