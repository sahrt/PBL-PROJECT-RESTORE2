
@extends('layouts/main')


@section('container')

    <div class="d-flex justify-content-center" style="margin-top: 220px;margin-bottom:225px">
        <div class="alert alert-success" role="alert">
        <h4>{{ $user[0]->name }}</h4>
        <h4 class="alert-heading">Well done! Selamat Pengisian Anda Tersimpan</h4>
        <p>Yeah Jangan Lupakan Dari Mana kamu berasal, jadilah kebanggan kami, semangat menjalani hidup, </p>
        <hr>
        <p class="mb-0">Silahkan Kembalih ke <a href="{{ route('home')}}">Home</a></p>
      </div> 
    </div>

  
@endsection
