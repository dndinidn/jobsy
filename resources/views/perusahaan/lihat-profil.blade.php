@extends('perusahaan.master') 

@section('konten')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Profil Pengguna</h2>
            </div>
            <div class="col-lg-8">
                <div class="p-4 mb-3 bg-white">
                    <p class="mb-0 font-weight-bold">Nama:</p>
                    <p class="mb-4">{{ $user->name }}</p>

                    <p class="mb-0 font-weight-bold">Email:</p>
                    <p class="mb-4">{{ $user->email }}</p>


                    {{-- Example: Link to edit profile --}}
                    @if (Auth::check() && Auth::user()->id === $user->id)
                        <p><a href="#" class="btn btn-primary btn-sm">Edit Profil</a></p>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="p-4 mb-3 bg-white">
                    <h3 class="h5 text-black mb-3">Tentang Saya</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi vitae eaque inventore beatae.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection