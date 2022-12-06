@extends('admin.layouts.main')

<style>
  @media print{ 
    #cetak,#navbar,#aksi{
      display: none;
    }
  }
</style>

@section('container')
<div class="content-wrapper">
  <div class="container mt-3">
    <div class="box-header with-border">
      @foreach ($title as $item)
      <h3 class="box-title">Data Alumni Jurusan {{ $item->nama_jurusan }}</h3>
      @endforeach
          <a href="" style=" float:right;" id="cetak" type="button" class="btn btn-rounded btn-success mb-5">Cetak Daftar</a>
    </div>
    <table id="table" class="table table-bordered text-center">
      <tr>
        <th>Nisn</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Nomor Hp</th>
        <th>Tahun Lulus</th>
      </tr>
      @forelse($alumni as $data) 
        <tr>
          <td>{{$data->nisn }}</td>
          <td>{{$data->name}}</td>
          <td>{{$data->email}}</td>
          <td>{{$data->nomer}}</td>
          <td>{{ $data->tahun_lulus }}</td>
        </tr>
      @empty
      <tr>
        <td colspan="6"><h3 class="text-center" style="opacity: 50%"> Belum Data Alumni</h3></td>
      </tr>
      @endforelse 
    </table>
  </div>
</div>
@endsection