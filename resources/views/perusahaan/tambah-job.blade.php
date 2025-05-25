@extends('perusahaan.master') {{-- Sesuaikan dengan layout utama adminmu --}}

@section('konten')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Job</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('simpan-job') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Judul Pekerjaan</label>
            <input type="text" name="title" class="form-control" required>
        </div>

    <div class="form-group">
    <label for="location_id">Lokasi</label>
    <select name="location_id" id="location_id" class="form-control select2" required>
        <option value="" disabled selected>Pilih Lokasi</option>
        @foreach ($regions as $region)
            <option value="{{ $region->id }}">{{ $region->name }}</option>
        @endforeach
    </select>
</div>

        <div class="form-group">
            <label for="employment_type">Tipe Pekerjaan</label>
            <select name="employment_type" class="form-control" required>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
            </select>
        </div>

        <div class="form-group">
            <label for="salary">Gaji</label>
            <input type="text" name="salary" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control" rows="6" required></textarea>
        </div>
<div class="form-group">
    <label for="kategoriDropdown">Kategori Pekerjaan</label>
    <button class="btn btn-outline-primary btn-sm mb-2" type="button" data-toggle="collapse" data-target="#kategoriDropdown" aria-expanded="false" aria-controls="kategoriDropdown">
        Pilih Kategori
    </button>
    <div class="collapse" id="kategoriDropdown">
        <div class="card card-body">
            @foreach ($kategoris as $kategori)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="kategori_id[]" id="kategori{{ $kategori->id }}" value="{{ $kategori->id }}">
                    <label class="form-check-label" for="kategori{{ $kategori->id }}">
                        {{ $kategori->nama_kategori }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>


        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('lihat-job') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
