@extends('layout.master')
@section('konten')

<section class="site-section">
  <div class="container">
    <h2>Lamar Pekerjaan: {{ $job->title }}</h2>
    <form action="{{ route('lamaran.store', $job->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Telepon</label>
        <input type="text" name="telepon" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Upload CV (PDF)</label>
        <input type="file" name="cv" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Kirim Lamaran</button>
    </form>
  </div>
</section>

@endsection
