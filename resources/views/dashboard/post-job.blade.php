@extends('layout.master')
@section('konten')

<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h1 class="text-white font-weight-bold">Posting Lowongan Kerja</h1>
      </div>
    </div>
  </div>
</section>

<section class="site-section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-12">
        <form class="p-4 p-md-5 border rounded" method="POST" action="#">
          @csrf

          <h3 class="text-black mb-5 border-bottom pb-2">Detail Lowongan</h3>

          <div class="form-group">
            <label for="judul">Judul Pekerjaan</label>
            <input type="text" class="form-control" id="judul" name="judul" placeholder="Contoh: Desainer Produk" required>
          </div>

          <div class="form-group">
            <label for="lokasi">Lokasi</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Contoh: Jakarta" required>
          </div>

          <div class="form-group">
            <label for="tipe_pekerjaan">Tipe Pekerjaan</label>
            <select class="form-control" id="tipe_pekerjaan" name="tipe_pekerjaan" required>
              <option value="">-- Pilih Tipe --</option>
              <option value="Full-time">Full-time</option>
              <option value="Part-time">Part-time</option>
              <option value="Contract">Contract</option>
              <option value="Freelance">Freelance</option>
            </select>
          </div>

          <div class="form-group">
            <label for="kategori_id">Kategori</label>
            <select class="form-control" id="kategori_id" name="kategori_id" required>
              <option value="">-- Pilih Kategori --</option>
              @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="gaji">Gaji</label>
            <input type="text" class="form-control" id="gaji" name="gaji" placeholder="Contoh: Rp8.000.000 - Rp10.000.000" required>
          </div>

          <div class="form-group">
            <label for="tanggal_diposting">Tanggal Diposting</label>
            <input type="date" class="form-control" id="tanggal_diposting" name="tanggal_diposting" value="{{ date('Y-m-d') }}" required>
          </div>

          <div class="form-group">
            <label for="deskripsi">Deskripsi Pekerjaan</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="6" placeholder="Tulis deskripsi pekerjaan di sini..." required></textarea>
          </div>

          <div class="form-group text-right">
            <button type="submit" class="btn btn-primary btn-md">Simpan Lowongan</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>

<footer class="site-footer text-center">
  <div class="container">
    <p class="copyright">
      &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | Template by <a href="https://colorlib.com" target="_blank">Colorlib</a>
    </p>
  </div>
</footer>

@endsection
