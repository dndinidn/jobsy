@extends('perusahaan.master')

@section('konten')
<div class="site-section bg-light">
    <div class="container">
        <h2 class="mb-4">Edit Profil Perusahaan</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                       value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="profile_picture">Foto Profil</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">

              @if($user->profile_picture)
    <div class="mt-2">
        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Foto Profil" style="max-width: 150px;" class="img-thumbnail rounded-circle">
    </div>
@else
    <div class="mt-2">
        <img src="{{ asset('assets-admin/img/undraw_profile_1.svg') }}" alt="Foto Profil" style="max-width: 150px;" class="img-thumbnail rounded-circle">
    </div>
@endif


            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('lihat.profil.perusahaan') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

@endsection
