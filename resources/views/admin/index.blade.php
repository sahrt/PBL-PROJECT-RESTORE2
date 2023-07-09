@extends('admin.layouts.main')

<style>
    @media print{
  
      #cetak,#navbar,#paginate{
        display: none;
      }
    }
  </style>

@section('container')
<div class="content">
    <div class="page-inner mt-3">
        <div class="row mt-2">
            <div class="col-md">
                <div class="card full-height">
                    <div class="card-body shadow-sm">
                        <div class="card-title text-center"><h3>Data Alumni SMK Negeri Ihya Ulumudin</h3></div>
                        <div class="card-category text-center">data alumni beserta kondisinya</div>
                        @empty($alumni)
                            <h3 class="text-center text-danger">Data Belum Tersedia</h3>
                        @endempty
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4 mt-4">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-1"></div>
                                <h6 class="fw-bold mt-3 mb-0">Jumlah Alumni</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-2"></div>
                                <h6 class="fw-bold mt-3 mb-0">Bekerja</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-3"></div>
                                <h6 class="fw-bold mt-3 mb-0">wirausaha</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-4"></div>
                                <h6 class="fw-bold mt-3 mb-0">kuliah</h6>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cotainer mt-4 mb-3 px-2 shadow rounded">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered text-center">
                            <tr>
                              <th>Nisn</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Nomor Hp</th>
                              <th>Jurusan</th> 
                              <th>Tahun Lulus</th>
                              <th>Status</th>
                              <th>Pendapatan</th>
                            </tr>
                            @forelse($viewAlumni as $data) 
                            <tr>
                                <td>{{ $data->nisn }}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->nomer}}</td>
                                <td>{{$data->jurusan->nama_jurusan}}</td>
                                <td>{{$data->tahun_lulus}}</td>
                                @if ($data->tracer_answer === null)
                                    <td>Belum Diketahui</td>
                                @else
                                    <td>{{ $data->tracer_answer->soal1 }}</td>
                                @endif
                            
                                @if ($data->tracer_answer === null)
                                    <td>Belum Diketahui</td>
                                @else
                                    <td>Rp. {{ $data->tracer_answer->soal6 }}</td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                              <td colspan="7"><h3 class="text-center" style="opacity: 50%">Belum Ada Data Alumni</h3></td>
                            </tr>
                            @endforelse 
                          </table>
                    </div>
                      <div class="d-flex justify-content-center" id="paginate">                        
                          {{ $viewAlumni->links() }}
                      </div>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto mt-3 mb-3">
                    <a href="" id="cetak" class="btn btn-success" type="button">Cetak Rekap Data</a>
                  </div> 
            </div>
        </div>

        </div>
    </div>
</div>


<!-- Chart Circle -->
<script src="assets/js/chart-circle/circles.min.js"></script>
<script type="text/javascript">

    Circles.create({
        id:'circles-1',
        radius:45,
        value:100,
        maxValue:100,
        width:7,
        text: <?php echo $alumni ?>,
        colors:['#e36a02', '#020073'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })


    Circles.create({
        id:'circles-2',
        radius:45,
        value:100,
        maxValue:100,
        width:7,
        text: <?php echo $bekerja ?>,
        colors:['#e36a02', '#020073'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })


    Circles.create({
        id:'circles-3',
        radius:45,
        value:100,
        maxValue:100,
        width:7,
        text: <?php echo $wirausaha ?>,
        colors:['#e36a02', '#020073'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })
    Circles.create({
        id:'circles-4',
        radius:45,
        value:100,
        maxValue:100,
        width:7,
        text: <?php echo $kuliah ?>,
        colors:['#e36a02', '#020073'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })
</script>
@endsection