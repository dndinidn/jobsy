  <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><a href="{{ url('/berandaa') }}">Jobsy</a></div>

          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><a href="{{ url('/beranda') }}" class="nav-link active">Home</a></li>
              <li><a href="{{ url('/job-listings') }}" class="nav-link active">Job Listing</a></li>
              <li><a href="{{ url('/contact') }}" class="nav-link active">Contact</a></li>
              

              {{-- <li class="d-lg-none"><a href="post-job.html"><span class="mr-2">+</span> Post a Job</a></li> --}}
              <li class="d-lg-none"><a href="{{ url('/login') }}">Log In</a></li>
              <li class="d-lg-none"><a href="{{ url('/register') }}">Register</a></li>
            </ul>
          </nav>
          
          <div class="right-cta-menu text-right d-flex aligin-items-center col-6">
            <div class="ml-auto">
              <a href="{{ url('/register') }}" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block"></span>Register</a>
              <a href="{{ url('/login') }}" class="btn btn-primary border-width-2 d-none d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Log In</a>
            </div>
            <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span class="icon-menu h3 m-0 p-0 mt-2"></span></a>
          </div>

        </div>
      </div>
    </header>