@extends('layout.master')

@section('konten')

<section class="section-hero home-section overlay inner-page bg-image" style="background-image: url('/assets/images/bg_profile.jpg');" id="home-section">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-12">
        <div class="mb-5 text-center">
          <h1 class="text-white font-weight-bold">Edit Profil</h1>
        </div>
      </div>
    </div>
  </div>
  <a href="#next" class="scroll-button smoothscroll">
    <span class="icon-keyboard_arrow_down"></span>
  </a>
</section>

<section class="site-section" id="next" style="background-color: rgb(255, 255, 255); padding-top: 40px; padding-bottom: 40px;">
  <div class="container">
    <div class="card mx-auto" style="max-width: 500px; background-color: white;">
      <div class="card-body">
        <h2 class="card-title text-center mb-4">Edit Profil Anda</h2>

        {{-- Pesan Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Pesan Error Validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Harap perbaiki kesalahan berikut:
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form action="{{ route('profile.update.jobseeker') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT') {{-- Menggunakan metode PUT untuk operasi pembaruan --}}

          <div class="text-center mb-4">
            {{-- Menampilkan foto profil yang ada atau placeholder --}}
            <img src="{{ auth()->user()->profile && auth()->user()->profile->profile_picture
              ? asset('storage/' . auth()->user()->profile->profile_picture)
              : asset('assets-admin/img/undraw_profile_1.svg') }}"
              alt="Foto Profil"
              class="img-fluid rounded-circle mb-3"
              style="width: 150px; height: 150px; object-fit: cover;">

            {{-- Input untuk mengunggah foto profil baru --}}
            <div class="form-group">
                <label for="profile_picture" class="d-block mt-2">Ubah Foto Profil:</label>
                <input type="file" class="form-control-file @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture">
                <small class="form-text text-muted">Unggah foto profil baru Anda (maksimal 2MB, format JPG, PNG, GIF).</small>
                @error('profile_picture')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
          </div>

          <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mt-4 text-center">
            <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
            <a href="{{ route('lihat.profil.jobseeker') }}" class="btn btn-secondary btn-block mt-2">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection
