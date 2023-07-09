
@extends('layouts.main')


@section('container')
<section style="background-color:#20a352;">
  <div class="container" style="padding-top: 50px;">
      <h1 style="color: white;">Hallo, {{$user->name}}</h1>
      <p style="color:wheat;">Ayo Persiapkan Tujuan Hidupmu, Masa Sekolah bukan Akhir segalahnya Semangat <br> Jadilah Orang Yang Bermanfaat</p>


</section>

<section>
    <div class="container">
        <div class="title">
            <h2>Data Diri Anda</h2>
            <h4>Periksa Kembali Data Anda Apakah Benar ?</h4>
        </div>
        
        <br>
        <div class="border p-5 shadow-lg" style="font-size: 100%;" >
        <table class="table table-borderless" style="font-weight:500; ">
          <tr>
            <td>
              <figure class="figure">
                @if ($user->foto)
                <img src="{{ asset('storage/'.$user->foto) }}" class=" img-thumbnail img-fluid rounded " alt="..." width="150">
                @else
                <img src="{{ asset('assets/img/user.png') }}" alt=""  width="150">
                @endif
                
                <br>
                <br>
                <h6>Ubah foto ?</h6>

                <figcaption class="figure-caption">
                  <form action="{{ route('uploud') }}" method="post" enctype="multipart/form-data">
                    @csrf
                 
                      <div class="input-group  input-group-sm mb-3">
                        <input type="file" name="image" class=" @error('image') is-invalid @enderror" id="inputGroupFile02">
                        <button class="btn btn-outline-light rounded" type="submit" id="inputGroupFileAddon04" style="background-color:blue;">upload</button>
                        @error('image')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                            
                        @enderror
                      </div>
                      
               
                  </form>
                </figcaption>
              </figure>
            <td>
            <td>
                  <tr>
                    <td>Nama </td>
                    <td> : </td>
                    <td>{{ $user->name }}</td> 
                  </tr>
                  
                  <tr>
                    <td>NISN </td>
                    <td> : </td>
                    <td>{{ $user->nisn }}</td>
                  </tr>
                    
                  <tr>
                    <td>Jurusan </td>
                    <td> : </td>
                    <td> {{ $user->jurusan_id }}</td>
                  </tr>
                   
                   
                  <tr>
                    <td>Nomer </td>
                    <td> : </td>
                    <td>{{ $user->nomer }}</td>
                  </tr>
                    
                  <tr>
                    <td>Tahun Lulus </td>
                    <td> : </td>
                    <td>{{ $user->tahun_lulus }}</td>
                  </tr>
                  <tr>
                    <td>
                        <br>
                        <br>
                        <div>
                            <h6>Jika Sudah Benar Silahkan Dimulai</h6>
                            <button class="w-10 btn btn-md my-3 text-white shadow" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: #154286" type="submit">Mulai</button>
                        </div>
                    </td>
                  </tr>
               
                  
                
            </td>
        </tr>
        </table>
        </div>
        <p class="pt-3" style="font-style:italic; color:red">Catatan bagi ada data yang tidak tepat segera lapor pada pihak admin sekolah ya !!!</p>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Apa Anda Yakin ?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Jika Sudah Yakin, Silahkan Mulai</p>
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="{{ route('viewSoal',['soal'=>'viewsoal','id' => encrypt(1)] )}}">
                <button type="button" class="btn btn-success">Mulai</button>
            </a>
         
        </div>
      </div>
    </div>
  </div>

  @endsection