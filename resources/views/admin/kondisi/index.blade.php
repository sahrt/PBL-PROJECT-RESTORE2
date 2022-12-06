@extends('admin.layouts.main')

<style>
  @media print{
    .aksi{
      display: none;
    } 

    #cetak,#navbar{
      display: none;
    }
  }
</style>

@section('container')
<div class="content-wrapper">
  <div class="container mt-3">
    <div class="row">
      <div class=" box-header with-border">
        <h3 class="box-title">Data Alumni Yang {{ $kondisi }}</h3>
            <a href="" style=" float:right;" id="cetak" type="button" class="btn btn-rounded btn-success mb-5">Cetak Daftar</a>
      </div>
    </div>
    <div class="row table-responsive">
      <table id="table" class="table table-bordered text-center">
        <tr>
          <th>Nisn</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Tahun Lulus</th>
          <th>Jurusan</th>
          <th>Nomor Hp</th>
        </tr>
        @forelse($alumni as $data) 
          <tr>
            <td>{{$data->alumni->nisn }}</td>
            <td>{{$data->alumni->name}}</td>
            <td>{{$data->alumni->email}}</td>
            <td>{{$data->alumni->tahun_lulus}}</td>
            <td>{{ $data->alumni->jurusan->nama_jurusan }}</td>
            <td>{{$data->alumni->nomer}}</td>
          </tr>
        @empty
        <tr>
          <td colspan="6"><h3 class="text-center" style="opacity: 50%"> Belum Ada Data Alumni</h3></td>
        </tr>
        @endforelse 
      </table>
    </div>
    <div class="d-flex justify-content-center" id="paginate">                        
      {{ $alumni->links() }}
    </div>
  </div>
</div>
@endsection