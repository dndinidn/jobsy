<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #e9fbe9;
    }
    .site-section {
      padding-top: 60px;
    }
    .form-control:focus {
      border-color: #28a745;
      box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }
    .border-green {
      border: 1px solid #28a745 !important;
    }
    .bg-green-light {
      background-color: #f0fff0;
    }
  </style>
</head>
<body>

<section class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 mb-5 mx-auto">
        <h2 class="mb-4 text-success">Login</h2>

        @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
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

        <form action="{{ url('/login') }}" method="POST" class="p-4 border border-green rounded bg-green-light">
          @csrf
          <div class="form-group mb-3">
            <label class="text-success">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>

          <div class="form-group mb-3">
            <label class="text-success">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-success w-100">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
