@extends('perusahaan.master')

@section('konten')
<div class="container">
    <h2>Daftar Lowongan Anda</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Lokasi</th>
                <th>Tipe</th>
                <th>Gaji</th>
                <th>Kategori</th>
                <th>Diposting</th>
                <th>Aksi</th> {{-- Kolom baru --}}
            </tr>
        </thead>
        <tbody>
            @forelse($lowongans as $lowongan)
                <tr>
                    <td>{{ $lowongan->title }}</td>
                    <td>{{ $lowongan->location }}</td>
                    <td>{{ $lowongan->employment_type }}</td>
                    <td>{{ $lowongan->salary }}</td>
                   
                    <td>
                        @foreach($lowongan->kategoris as $kategori)
                            <span class="badge bg-primary">{{ $kategori->nama_kategori }}</span>
                        @endforeach
                    </td>
                    <td>{{ \Carbon\Carbon::parse($lowongan->posted_at)->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('edit-job', $lowongan->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('hapus-job', $lowongan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lowongan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada lowongan yang ditambahkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
