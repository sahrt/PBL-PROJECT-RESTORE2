@extends('layouts.main')

@section('container')
<style>
    body{
    background-color: #20a352;
}
</style>
<div class="row justify-content-center">
    <div class="image-section justify-content-center d-flex mt-3">
        <img class="mb-4" src="{{ asset('assets/img/logo.png') }}" width="120px">
    </div>
    <div class="title text-center text-white">
        <h2>Selamat Datang</h2>
        <h5>Di Sistem Lacak Alumni SMK Negeri Ihya'Ulumudin</h5>
    </div>

    <div class="col-md-4 mt-3">
        @if (session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('loginError') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <main class="form-signin bg-white px-3 py-4 rounded-3 shadow" style="margin-bottom: 90px">
            <form action="{{ route('loginProcess') }}" method="post">
                @csrf
                <div class="d-flex justify-content-center">
                    <h5>Silahkan Masukkan Nisn/Nik/Nis Anda</h5>
                </div>
                <div class="help justify-content-center d-flex mb-3 ">
                    <small class="fst-italic">Jika Lupa Nisn silakan Lihat <a href="https://nisn.data.kemdikbud.go.id/index.php/Cindex/formcaribynama" target="blank"> Disini</a></small>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" id="floatingInput" placeholder="35xxxxxxx" required value="{{ old('nisn') }}">
                    <label for="floatingInput">NISN/NIK/NIS</label>
                    @error('nisn')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg my-3 text-white shadow" style="background-color: #154286" type="submit">Mulai</button>
            </form>
        </main>
    </div>
</div>
@endsection