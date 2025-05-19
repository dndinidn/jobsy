@extends('master')
@section('konten')

<section class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 mb-5">
        <h2 class="mb-4">Login</h2>

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

        <form action="{{ url('/login') }}" method="POST" class="p-4 border rounded">
          @csrf
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>

          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection
