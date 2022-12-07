@extends('layouts/main')



@section('container')
<section style="background-color: rgb(63, 63, 180);">
  <div class="container" style="padding-top: 50px;">
      <h1 style="color: white;">Hallo, {{$user->name}}</h1>
      <p style="color:wheat;">Ayo Persiapkan Tujuan Hidupmu, Masa Sekolah bukan Akhir segalahnya Semangat <br> Jadilah Orang Yang Bermanfaat</p>
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
        <form action="{{ route('soal4-process') }}" method="post">
          @csrf
            <div class="title pt-4">
                <h4>4. Tingkat lulusan pendidikan apa untuk masuk pekerjaan anda saat ini? </h4>
               </div>
            <div class="container"> 
              <div class="  label-background form-check border rounded"  style="padding:5px; margin: 2px; ">
                <button class="btn  button"  type="button">
                 <input type="radio" name="tingkat" id="from-AFIRMASI" value=" Setingkat Lebih Tinggi (D3,S1,S2)" style="width: 20px;">
                 <label class="form-check-label" for="from-AFIRMASI" >
                  Setingkat Lebih Tinggi (D3,S1,S2)
                </label> 
              
                </button>
              </div>
       
              <div class="  label-background form-check border rounded"  style="padding:5px; margin: 2px; ">
                <button class="btn  button"  type="button">
                 <input type="radio" name="tingkat" id="from-AFIRMASI" value="Tingkat yang sama (SMA,SMK,MA)">
                 <label class="form-check-label" for="from-AFIRMASI" >
                  Tingkat yang sama (SMA,SMK,MA)
                </label> 
              
                </button>
              </div>

              <div class="  label-background form-check border rounded"  style="padding:5px; margin: 2px; ">
                <button class="btn  button"  type="button">
                 <input type="radio" name="tingkat" id="from-AFIRMASI" value=" Setingkat Lebih Rendah (SMP,SD,DLL)">
                 <label class="form-check-label" for="from-AFIRMASI" >
                  Setingkat Lebih Rendah (SMP,SD,DLL)
                </label> 
              
                </button>
              </div>
            
                <div class="  label-background form-check border rounded"  style="padding:5px; margin: 2px; ">
                  <button class="btn  button"  type="button">
                   <input type="radio" name="tingkat" id="from-AFIRMASI" value=" Tidak Perlu Pendidikan  (TIDAK BERSEKOLAH)">
                   <label class="form-check-label" for="from-AFIRMASI" >
                   Tidak Perlu Pendidikan  (TIDAK BERSEKOLAH)
                  </label> 
                
                  </button>
                </div>

            <div class="button d-flex justify-content-between" style="margin-top: 20px; margin-left:10px; margin-right:10px;">
                 <a  href="{{ route('viewSoal',['soal'=>'soal3']) }}">
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