@extends('layout.master')
@section('konten')

<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('{{ asset('images/hero_1.jpg') }}');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">{{ $job->title }}</h1>
                <div class="custom-breadcrumbs">
                    <a href="{{ url('/') }}">Home</a> <span class="mx-2 slash">/</span>
                    <a href="{{ url('/jobs') }}">Job</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>{{ $job->title }}</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="d-flex align-items-center">
                    <div class="border p-2 d-inline-block mr-3">
                        <img src="{{
                            $job->user && $job->user->profile && $job->user->profile->profile_picture
                                ? asset('storage/' . $job->user->profile->profile_picture)
                                : asset('assets-admin/img/undraw_profile_1.svg')
                            }}"
                            alt="Logo Perusahaan"
                            style="max-width: 100px;">
                    </div>
                    <div>
                        <h2>{{ $job->title }}</h2>
                        <div>
                            <span class="icon-briefcase mr-2"></span>{{ $job->user->name ?? 'Nama Perusahaan' }}
                            <span class="m-2"><span class="icon-room mr-2"></span>{{ $job->location->name ?? $job->location }}</span>
                            <span class="m-2"><span class="icon-clock-o mr-2"></span><span class="text-primary">{{ $job->employment_type }}</span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('lamaran.create', ['lowongan_id' => $job->id]) }}" class="btn btn-block btn-primary btn-md">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="mb-5">
                    <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Job Description</h3>
                    <p>{{ $job->description }}</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="bg-light p-3 border rounded mb-4">
                    <h3 class="text-primary mt-3 h5 pl-3 mb-3">Job Summary</h3>
                    <ul class="list-unstyled pl-3 mb-0">
                        <li class="mb-2"><strong class="text-black">Published on:</strong> {{ $job->created_at->format('F d, Y') }}</li>
                        <li class="mb-2"><strong class="text-black">Employment Status:</strong> {{ $job->employment_type }}</li>
                        <li class="mb-2"><strong class="text-black">Job Location:</strong> {{ $job->location->name ?? $job->location }}</li>
                        <li class="mb-2"><strong class="text-black">Salary:</strong> {{ $job->salary }}</li>
                        <li class="mb-2"><strong class="text-black">Sisa Kuota:</strong> {{ $job->jumlah_orang }}</li>
                        <li class="mb-2"><strong class="text-black">Categories:</strong>
                            @if ($job->kategoris && count($job->kategoris) > 0)
                                @foreach($job->kategoris as $kategori)
                                    <span class="badge bg-primary">{{ $kategori->nama_kategori }}</span>
                                @endforeach
                            @else
                                <span>-</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
