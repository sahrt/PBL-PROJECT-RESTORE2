@extends('layouts/main')


@section('container')
<section style="background-color: rgb(63, 63, 180);">
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
        <h2>Pelacak Alumni</h2>
      </div>

      <div class="row justify-content-center " style="padding: 20px;">
        <form action="{{ route('soal6-process') }}" method="post">
          @csrf
          <input type="hidden" name="id" value="{{ $user->id }}">
          <input type="hidden" name="nisn" value="{{ $user->nisn }}">
            <div class="title pt-4">
                <h4>6. Gaji Pekerjaan Yang Anda Dapat ? </h4>
               </div>
            <div class="container"> 
              <div class="  label-background form-check  rounded"  style="padding:5px; ">
                 <label class="form-check-label" for="from-AFIRMASI" >
                  Dari Pekerjaan Utama (Rp.)
                </label>
                 <input class="form-control" type="number" name="gaji_utama" id="from-AFIRMASI"  required>
                 
              
              </div>
       
              <div class="  label-background form-check rounded"  style="padding:5px; margin: 2px; ">
                <label class="form-check-label" for="from-AFIRMASI" >
                  Dari Lembur dan Tip (Rp.)
                </label> 
                 <input class="form-control" type="number" name="lembur" id="from-AFIRMASI" required>
              
              
              </div>

              <div class="label-background form-check rounded "  style="padding:5px; ">
              
                <label class="form-check-label" for="from-AFIRMASI" >
                  Dari Perkerjaan Lainya (Rp.)
                </label> 
                 <input class="form-control" type="number" name="gaji_lain" id="from-AFIRMASI" required>
              </div>

                 

            <div class="button d-flex justify-content-between" style="margin-top: 20px; margin-left:10px; margin-right:10px;">
                  <a  href="{{ route('viewSoal',['soal'=>'soal5']) }}">
                   <button type="button" class="btn btn-primary">Back</button>
                </a> 
                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Simpan</button>
            </div>
        </form>
      </div>    
    </div>
  </section><!-- End About Us Section -->



</div>


@endsection