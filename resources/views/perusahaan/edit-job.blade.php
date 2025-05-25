@extends('perusahaan.master') {{-- Sesuaikan dengan layout utama adminmu --}}

@section('konten')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Job</h1>

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

    <form action="{{ route('update-job', $lowongan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Judul Pekerjaan</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $lowongan->title) }}" required>
        </div>

        <div class="form-group">
            <label for="location_id">Lokasi</label>
            <select name="location_id" id="location_id" class="form-control select2" required>
                <option value="" disabled>Pilih Lokasi</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" {{ $lowongan->location_id == $region->id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="employment_type">Tipe Pekerjaan</label>
            <select name="employment_type" class="form-control" required>
                <option value="Full-time" {{ $lowongan->employment_type == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                <option value="Part-time" {{ $lowongan->employment_type == 'Part-time' ? 'selected' : '' }}>Part-time</option>
            </select>
        </div>

        <div class="form-group">
            <label for="salary">Gaji</label>
            <input type="text" name="salary" class="form-control" value="{{ old('salary', $lowongan->salary) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control" rows="6" required>{{ old('description', $lowongan->description) }}</textarea>
        </div>

        <div class="form-group">
    <label for="kategoriDropdown">Kategori Pekerjaan</label>
    <button class="btn btn-outline-primary btn-sm mb-2" type="button" data-toggle="collapse" data-target="#kategoriDropdown" aria-expanded="false" aria-controls="kategoriDropdown">
        Pilih Kategori
    </button>
    <div class="collapse" id="kategoriDropdown"> {{-- collapse TERTUTUP secara default --}}
        <div class="card card-body">
            @foreach ($kategoris as $kategori)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="kategori_id[]" id="kategori{{ $kategori->id }}" value="{{ $kategori->id }}"
                        {{ $lowongan->kategoris->pluck('id')->contains($kategori->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="kategori{{ $kategori->id }}">
                        {{ $kategori->nama_kategori }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>


        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('lihat-job') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
