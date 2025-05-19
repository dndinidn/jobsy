<header class="site-navbar mt-3">
  <div class="container-fluid">
    <div class="row align-items-center">
      
      <!-- Logo -->
      <div class="site-logo col-6">
        <a href="{{ url('/beranda') }}">Jobsy</a>
      </div>

      <!-- Navigasi Tengah -->
      <nav class="mx-auto site-navigation">
        <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
          <li><a href="{{ url('/beranda') }}" class="nav-link active">Home</a></li>
          <li><a href="{{ url('/job-listings') }}" class="nav-link active">Job Listing</a></li>
          <li><a href="{{ url('/my-applications') }}" class="nav-link active">My Applications</a></li>

          @guest
            <!-- Navigasi versi mobile (tampil hanya di layar kecil) -->
            <li class="d-lg-none"><a href="{{ url('/login') }}">Log In</a></li>
            <li class="d-lg-none dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Register</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ url('/registrasi-jobseeker') }}">Register as Job Seeker</a></li>
                <li><a class="dropdown-item" href="{{ url('/registrasi-employer') }}">Register as Employer</a></li>
              </ul>
            </li>
          @endguest

          @auth
            <!-- Optional: Bisa tampilkan nama user atau menu lain -->
            <li class="d-lg-none">
              <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-link nav-link" style="padding:0; border:none; background:none; cursor:pointer;">
                  Logout
                </button>
              </form>
            </li>
          @endauth
        </ul>
      </nav>

      <!-- CTA kanan (Desktop) -->
      <div class="right-cta-menu text-right d-flex align-items-center col-6">
        <div class="ml-auto d-none d-lg-inline-block">
          @guest
            <!-- Dropdown Register untuk Desktop -->
            <div class="btn-group">
              <button type="button" class="btn btn-outline-white border-width-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Register
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ url('/registrasi-jobseeker') }}">Register as Job Seeker</a>
                <a class="dropdown-item" href="{{ url('/registrasi-employer') }}">Register as Employer</a>
              </div>
            </div>
            <!-- Tombol Login -->
            <a href="{{ url('/login') }}" class="btn btn-primary border-width-2 ml-2">
              <span class="mr-2 icon-lock_outline"></span>Log In
            </a>
          @endguest

          @auth
            <!-- Tombol Logout Desktop -->
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
              @csrf
              <button type="submit" class="btn btn-danger border-width-2 ml-2">
                Logout
              </button>
            </form>
          @endauth
        </div>

        <!-- Toggle menu versi mobile -->
        <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3">
          <span class="icon-menu h3 m-0 p-0 mt-2"></span>
        </a>
      </div>

    </div>
  </div>
</header>
