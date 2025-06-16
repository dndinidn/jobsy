@extends('perusahaan.master')

@section('konten')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <!-- Judul -->
            <div class="col-md-12">
                <h2 class="mb-4">Profil Perusahaan</h2>
            </div>

            <!-- Bagian Informasi Profil -->
            <div class="col-lg-8">
                <div class="p-4 mb-3 bg-white">
                    <!-- Foto Profil -->
                    <div class="mb-4 text-center">
                        <img src="{{ $user->profile && $user->profile->profile_picture ? asset('storage/' . $user->profile->profile_picture) : asset('assets-admin/img/undraw_profile_1.svg') }}"
                             alt="Foto Profil" class="img-fluid rounded-circle" style="max-width: 150px;">
                    </div>

                    <p class="mb-0 font-weight-bold">Nama:</p>
                    <p class="mb-4">{{ $user->name }}</p>

                    <p class="mb-0 font-weight-bold">Email:</p>
                    <p class="mb-4">{{ $user->email }}</p>

                    <!-- Tambahkan informasi perusahaan lain jika ada -->
                    

                    <!-- Tombol Edit Profil -->
                    @if (Auth::check() && Auth::user()->id === $user->id)
                        <a href="{{ route('perusahaan.edit.profil') }}" class="btn btn-primary btn-sm">Edit Profil</a>
                    @endif
                </div>
            </div>

            <!-- Bagian Tentang Saya atau Deskripsi Perusahaan -->
            <div class="col-lg-4">
                <div class="p-4 mb-3 bg-white">
                    <h3 class="h5 text-black mb-3">Tentang Saya</h3>
                    <p>{{ $user->profile && $user->profile->about ? $user->profile->about : 'Belum ada deskripsi tentang perusahaan.' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
