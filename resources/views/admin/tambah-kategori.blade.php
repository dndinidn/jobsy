@extends('admin.master')

@section('konten')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Kategori</h1>

    <form action="{{ route('simpan-kategori') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('tambah-kategori') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
