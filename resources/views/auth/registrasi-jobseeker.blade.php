<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #e9fbe9;
    }

    .section-hero {
      padding: 100px 0;
      background-size: cover;
      background-position: center;
      position: relative;
    }

    .overlay::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 128, 0, 0.6);
      z-index: 1;
    }

    .section-hero .container,
    .section-hero .row,
    .section-hero .col-md-7 {
      position: relative;
      z-index: 2;
    }

    .form-control::placeholder {
      color: #fff !important;
    }

    .form-control {
      background-color: #4caf50;
      color: #fff;
      border: 1px solid #388e3c;
    }

    .form-control:focus {
      background-color: #43a047;
      border-color: #2e7d32;
      color: #fff;
      box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.5);
    }

    .btn-success {
      background-color: #2e7d32;
      border: none;
    }

    .btn-success:hover {
      background-color: #1b5e20;
    }

    .custom-breadcrumbs a,
    .custom-breadcrumbs .slash {
      color: #fff;
    }

    .form-wrapper {
      display: flex;
      justify-content: center;
    }
  </style>
</head>
<body>

<!-- HOME Section -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h1 class="text-white font-weight-bold">Registrasi</h1>
        <div class="custom-breadcrumbs">
          <a href="#">Home</a> <span class="mx-2 slash">/</span>
          <span class="text-white"><strong>Registrasi</strong></span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FORM Section -->
<section class="site-section py-5">
  <div class="container">
    <div class="row form-wrapper">
      <div class="col-lg-6 mb-5">
        <h2 class="mb-4">Form Registrasi</h2>

        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ url('registrasi/user') }}" method="post" class="p-4 border rounded bg-white">
          @csrf

          <div class="mb-3">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Lengkap" required>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required>
          </div>

          <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
          </div>

          <div class="mb-3">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-success w-100">Registrasi</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
