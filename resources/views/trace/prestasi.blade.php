

@extends('layouts/main')


@section('container')
<section style="background-color: #20a352;">
  <div class="container" style="padding-top: 50px;">
      <h1 style="color: white;">Hallo, {{$user->name}}</h1>
      <p style="color:wheat;">Ayo Persiapkan Tujuan Hidupmu, Masa Sekolah bukan Akhir segalahnya Semangat <br> Jadilah Orang Yang Bermanfaat</p>
            @if (Session::has('success'))
      <div class="alert alert-success">
          {{ Session::get('success') }}
          @php
              Session::forget('success');
          @endphp
      </div>
  @endif
  @if (Session::has('error'))
      <div class="alert alert-warning">
          {{ Session::get('error') }}
          @php
              Session::forget('error');
          @endphp
      </div>
  @endif

  <!-- Menampilkan Error form validation -->
  @if ($errors->any())
  <div class="alert alert-danger">
       <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
  </div>
    </div>
  </div>

</section>
<div class="container">


  <section id="about" class="about">
    <div class="container" data-aos="fade-up" style="padding: 20px;">

      <div class="section-title text-center">
        <h2 class="text-success">Pelacak Alumni</h2>
      </div>

      <div class="row justify-content-center " style="padding: 20px;">
        <form action="{{route('soal11-process')}}" method="post">
          @csrf
            <div class="title pt-4">
                <h4>8. Pernah Memiliki Prestasi Pada Masa Sekolah</h4>
               </div>
            <div class="container"> 
              <div class="  label-background form-check border rounded "data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"   style="padding:15px; margin: 2px; ">
                 <input type="radio" name="corona" id="from-AFIRMASI" style="width: 20px;" value="">
                 <label class="form-check-label" for="from-AFIRMASI" >
                  Ya
                </label> 

              </div>
       
              <div class="  label-background form-check border rounded"  style="padding:15px; margin: 2px; ">
                 <input type="radio" name="nama_prestasi" id="from-AFIRMASI2" value="tidak ada">
                 <label class="form-check-label" for="from-AFIRMASI2" >
                  Tidak
                </label> 
              </div>
          
            <div class="button d-flex justify-content-between" style="margin-top: 20px; margin-left:10px; margin-right:10px;">
                  <a href="{{ route('viewSoal',['soal'=>'viewsoal','id'=> encrypt($id-1)])}}">
                   <button type="button" class="btn btn-primary">Back</button>
                </a> 
                  <button type="submit" class="btn btn-success" data-bs-dismiss="modal">finish</button>
              
            </div>
        </form>
      </div>    
    </div>
  </section><!-- End About Us Section -->



</div>

<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Silahkan Isi Keterangan Kejuaraan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('soal11-process') }}" method="POST">
            @csrf
            <div class="  label-background form-check border rounded"  style="padding:15px; margin: 2px; ">
             <label class="form-check-label" for="from-AFIRMASI" >
                Nama Prestasi
             </label> 
             <br>
             <br>
              <input type="text" class="form-control" name="nama_prestasi" id="from-AFIRMASI" placeholder="masukan Prestasi Kamu" required>
           </div>
              <div class="  label-background form-check border rounded"  style="padding:15px; margin: 2px; ">
                <label class="form-check-label" for="from-AFIRMASI" >
                 Tingkat Kejuaraan
                </label> 
                <br>
                <br>
              <input type="text" class="form-control" name="juara" id="from-AFIRMASI" placeholder="juara berapa" required >
             
              </div>
            <div class="  label-background form-check border rounded"  style="padding:15px; margin: 2px; " >
              <label class="form-check-label" for="from-AFIRMASI" >
                Lingkup Kejuaraan
             </label>
             <br>
             <br> 
             <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="tingkat" required>
                <option selected>Pilih Tingkat Prestasi Kejuaraan Kamu</option>
                <option value="lokal">Lokal</option>
                <option value="kabupaten">Kabupaten</option>
                <option value="provinsi">Provinsi</option>
                <option value="nasional">Nasional</option>
                <option value="internasional">Internasional</option>
              </select>
              </div>
               <div class="  label-background form-check border rounded"  style="padding:15px; margin: 2px; ">
                 <label class="form-check-label" for="from-AFIRMASI" >
                  Peran Kejuaraan
                 </label> 
                 <br>
                 <br>
                <input type="Text" class="form-control" name="peran" id="from-AFIRMASI" placeholder="masukan peran anda" required>
                
              </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>

@endsection