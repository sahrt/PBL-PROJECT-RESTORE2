
@extends('layouts/main')



@section('container')
<section class="shadow-lg" style="background-color: #20a352;">
  <div class="container" style="padding-top: 50px;">
      <h1 style="color: white;">Hallo, {{$user[0]->name}}</h1>
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


</section>
<div class="container">


  <section id="about" class="about">
    <div class="container" data-aos="fade-up" style="padding: 20px;">

      <div class="section-title text-center">
        <h2 class="text-success">Pelacak Alumni</h2>
      </div>

      <div class="row" style="padding: 20px;">
        <form action="{{ route('viewsoal-proses') }}" method="post">
          @csrf
          <input type="hidden" name="id" value="{{ encrypt($id)}}">
          
           @foreach ($array_soal as $soal)
               
            <div class="title pt-4">
                <h4>{{ $soal->soal }}</h4>
               </div>
            <div class="container"> 
              <div class="  label-background form-check border rounded"  style="padding:5px; margin: 2px; ">
                <button class="btn  button"  type="button">
                 <input type="radio" name="soal" id="from-AFIRMASI" value="{{ $soal->answer1 }}">
                 <label class="form-check-label" for="from-AFIRMASI" >
                {{ $soal->answer1 }}
                </label> 
              
                </button>
              </div>
       
              <div class="  label-background form-check border rounded"  style="padding:5px; margin: 2px; ">
                <button class="btn  button"  type="button">
                 <input type="radio" name="soal" id="from-AFIRMASI" value=" {{ $soal->answer2 }}">
                 <label class="form-check-label" for="from-AFIRMASI" >
                  {{ $soal->answer2 }}
                </label> 
              
                </button>
              </div>

              <div class="  label-background form-check border rounded"  style="padding:5px; margin: 2px; ">
                <button class="btn  button"  type="button">
                 <input type="radio" name="soal" id="from-AFIRMASI" value=" {{ $soal->answer3 }}">
                 <label class="form-check-label" for="from-AFIRMASI" >
                  {{ $soal->answer3 }}
                </label> 
              
                </button>
              </div>
            
                <div class="  label-background form-check border rounded"  style="padding:5px; margin: 2px; ">
                  <button class="btn  button"  type="button">
                   <input type="radio" name="soal" id="from-AFIRMASI" value="{{ $soal->answer4 }}">
                   <label class="form-check-label" for="from-AFIRMASI" >
                   {{ $soal->answer4 }}
                  </label> 
                
                  </button>
                </div>
                @endforeach
             <div class="d-flex justify-content-between mt-4" >
                @if ($id == 1 )
                  
                   <button type="button" class="btn btn-primary" disabled >
                    <a class="text-white"  href="{{ route('viewSoal',['soal'=>'viewsoal','id'=> encrypt($id-1)]) }}">Back</a></button>
                 
                    
                @else
                  
                  <button type="button" class="btn btn-primary">
                    <a class="text-white" href="{{ route('viewSoal',['soal'=>'viewsoal','id'=> encrypt($id-1)]) }}">Back</a>  
                  </button>
                
                @endif
                 
                
               
                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Simpan</button>
            </div>
        </form>
      </div>    
    </div>
  </section><!-- End About Us Section -->



</div>



@endsection