@extends('layout.master')
@section('konten')

<div class="container mt-5">
    <h2>Semua Saya</h2>

    @if($lamarans->isEmpty())
        <p>Anda belum mengirimkan lamaran apapun.</p>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Nama</th>

                    <th>Telepon</th>
                    <th>CV</th>
                    <th>Status</th> <!-- Tambah kolom Status -->
                    <th>Dilamar Pada</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lamarans as $lamaran)
                    <tr>
                        <td>{{ $lamaran->nama }}</td>
                       
                        <td>{{ $lamaran->telepon }}</td>
                        <td>
                            @if($lamaran->cv_path)
                                <a href="{{ asset('storage/' . $lamaran->cv_path) }}" target="_blank">Lihat CV</a>
                            @else
                                Tidak ada CV
                            @endif
                        </td>
                        <td>
                            @if($lamaran->status == 'Menunggu')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($lamaran->status == 'Diterima')
                                <span class="badge bg-success">Diterima</span>
                            @elseif($lamaran->status == 'Ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span>{{ $lamaran->status }}</span>
                            @endif
                        </td>
                        <td>{{ $lamaran->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
