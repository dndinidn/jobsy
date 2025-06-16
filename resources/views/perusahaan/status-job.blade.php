@extends('perusahaan.master')

@section('konten')

<section class="site-section py-5">
  <div class="container">
    <h2 class="mb-4">Lamaran Masuk</h2>

    @if($applications->isEmpty())
      <div class="alert alert-info">
        Belum ada lamaran masuk.
      </div>
    @else
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>Nama Pelamar</th>
              <th>No. HP</th>
              <th>CV</th>
              <th>Judul Lowongan</th>
              <th>Status Saat Ini</th>
              <th>Ubah Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($applications as $app)
              <tr>
                <td>{{ $app->nama }}</td>
                <td>{{ $app->telepon }}</td>
                <td>
                  @if($app->cv_path)
                    <a href="{{ asset('storage/' . $app->cv_path) }}" target="_blank" class="btn btn-sm btn-primary">Lihat CV</a>
                  @else
                    <span class="text-muted">Tidak ada CV</span>
                  @endif
                </td>
                <td>{{ $app->lowongan->title ?? '-' }}</td>
                <td>
                  <span class="badge
                    @if($app->status == 'menunggu') bg-warning
                    @elseif($app->status == 'diterima') bg-success
                    @elseif($app->status == 'ditolak') bg-danger
                    @else bg-secondary @endif
                  ">
                    {{ ucfirst($app->status) }}
                  </span>
                </td>
                <td>
                  <form action="{{ route('application.update.status', $app->id) }}" method="POST" class="m-0 p-0">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-select" onchange="this.form.submit()">
                      <option value="menunggu" {{ $app->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                      <option value="diterima" {{ $app->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                      <option value="ditolak" {{ $app->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif

  </div>
</section>

@endsection
