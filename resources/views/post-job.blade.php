@extends('master')
@section('konten')

<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h1 class="text-white font-weight-bold">Post A Job</h1>
      </div>
    </div>
  </div>
</section>

<section class="site-section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-12">
        <form class="p-4 p-md-5 border rounded" method="post">
          <h3 class="text-black mb-5 border-bottom pb-2">Job Details</h3>

          <div class="form-group">
            <label>Upload Featured Image</label><br>
            <label class="btn btn-primary btn-md btn-file">
              Browse File<input type="file" hidden>
            </label>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" placeholder="you@yourdomain.com">
          </div>

          <div class="form-group">
            <label for="job-title">Job Title</label>
            <input type="text" class="form-control" id="job-title" placeholder="Product Designer">
          </div>

          <div class="form-group">
            <label for="job-location">Location</label>
            <input type="text" class="form-control" id="job-location" placeholder="e.g. New York">
          </div>

          <div class="form-group">
            <label for="job-type">Job Type</label>
            <select class="form-control" id="job-type">
              <option>Part Time</option>
              <option>Full Time</option>
            </select>
          </div>

          <div class="form-group">
            <label for="job-description">Job Description</label>
            <textarea class="form-control" id="job-description" rows="6" placeholder="Write job description here..."></textarea>
          </div>

          <h3 class="text-black my-5 border-bottom pb-2">Company Details</h3>

          <div class="form-group">
            <label for="company-name">Company Name</label>
            <input type="text" class="form-control" id="company-name" placeholder="Company Name">
          </div>

          <div class="form-group">
            <label for="company-website">Website</label>
            <input type="text" class="form-control" id="company-website" placeholder="https://">
          </div>

          <div class="form-group">
            <label>Upload Logo</label><br>
            <label class="btn btn-primary btn-md btn-file">
              Browse File<input type="file" hidden>
            </label>
          </div>

          <div class="form-group text-right">
            <button type="submit" class="btn btn-primary btn-md">Save Job</button>
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
