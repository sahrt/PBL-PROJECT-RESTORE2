<?php

namespace App\Http\Controllers\API\trace;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\alumni;
use App\Models\Tracer_answer;
use App\Models\Punya_Prestasi;
use App\Models\Prestasi;

class traceController extends Controller
{
    public function readTrace () {
        $data = Tracer_answer::orderBy('id','desc')->get();
        
        return response()->json($data, 200);

    }
    public function readPrestasi (){
        $data =  Prestasi::orderBy('id','desc')->get();

        return response()->json($data, 200);
    }
    public function readPunyaPrestasi (){
        $data = Punya_Prestasi::orderBy('id','desc')->get();

        return response()->json($data, 200);
    }

    public function loginProcess(Request $request)
    {

        //nisn apakah terdaftar di database
        $credentials = $request->validate([
            'nisn' => 'required|min:4',
        ]);

        $data = alumni::where('nisn', '=', $credentials)->orwhere('nik', '=', $credentials)->orwhere('nis', '=', $credentials)->first();
     

        
        //kita check di database apakah ada nimnya
        $finish =  Tracer_answer::select('status')->where('alumni_id', $data->id)->first();


        //bilah mana $finis  null maka kita membuat pengimputan data baru
        if ($finish == null or $finish->status == null) {

            return 'login berhasil'.$data->name." ".$data->id."/".$data->nisn;
        }
        if ($finish->status == 'finised') {

            //misalnya user melkukan pengisina maka akan dilempar ke menu login kembali 
            //kemudian dilakukan penghapusan session
            return 'Anda Telah Mengisi Tracer Study '.$data->name."/".$data->nisn;
        }
    
    }

    //membuat authtentikasi apakah user benar beanr belum mengisi 


    //fungsi menampilkan soal
 

    //soal 1

    public function soal1Process(Request $request)
    {


        $request->validate([
            'akademi' => 'required',

        ]);

        if (Tracer_answer::where('alumni_id', $request->id)->first() == !null) {
            $user = Tracer_answer::where('alumni_id', $request->id)->first();
            $user->akademi = $request->akademi;
            $user->save();
            $data = alumni::find($request->id_user)->first();
            $data->tracer_answer_id = $user->id;
            $data->save();
            return redirect()->route('viewSoal', ['soal' => 'soal2']);
        } else if (Tracer_answer::where('alumni_id', $request->id)->first() == null) {
            $request->validate([
                'akademi' => 'required',
            ]);

            $user = new Tracer_answer();
            $user->alumni_id = $request->id;
            $user->nisn = $request->nisn;
            $user->akademi = $request->akademi;
            $user->save();
            $data = alumni::find($request->id)->first();
            $data->tracer_answer_id = $user->id;
            $data->save();

            return 'anda telah mengisi soal pertama';
        }
    }

    //soal 2

    public function soal2Process(Request $request)
    {
        $request->validate([
            'kategori' => 'required',

        ]);
        $user = Tracer_answer::where('alumni_id', $request->id)->first();
        $user->kategori = $request->kategori;
        $user->save();

        return 'anda telah mengisi soal 2';
    }

    //soal 3
    public function soal3Process(Request $request)
    {

        

        if ($request->tema == "Bekerja (Pegawai)" or $request->tema == "Bekerja (Pegawai) dan wirausaha") {
            $request->validate([
                'tema' => 'required',
                'nama_perusahaan' => 'required',
                'jabatan' => 'required',
                'jenis_perusahaan' => 'required',
                'kota' => 'required',
                'nomer' => 'required'
            ]);
        } else if ($request->tema == "wirausaha") {
            $request->validate([
                'tema' => 'required',
                'lesensi' => 'required',
                'name_usaha' => 'required',
                'bidang' => 'required',
                'sesuai' => 'required'

            ]);
        } else if ($request->tema == 'Tidak Bekerja' or $request->tema == 'Melanjutkan Kuliah') {
            $request->validate([
                'tema' => 'required',
            ]);
        }

        $user = Tracer_answer::where('alumni_id', $request->id)->first();
        $user->tema = $request->tema;
        $user->nama_perusahaan = $request->nama_perusahaan;
        $user->jabatan = $request->jabatan;
        $user->jenis_perusahaan = $request->jenis_perusahaan;
        $user->kota = $request->kota;
        $user->nomer = $request->nomer;
        $user->lesensi = $request->lesensi;
        $user->nama_usaha = $request->name_usaha;
        $user->bidang = $request->bidang;
        $user->sesuai = $request->sesuai;
        $user->save();
        return 'anda telah mengisi soal 3';
    }



    //soal4

    public function soal4Process(Request $request)
    {
        $request->validate([
            'tingkat' => 'required',

        ]);

        $user = Tracer_answer::where('alumni_id', $request->id)->first();
        $user->tingkat = $request->tingkat;
        $user->save();
        return 'anda telah mengisi soal 4';
    }

    //soal5
    public function soal5Process(Request $request)
    {
        $request->validate([
            'hubungan' => 'required',

        ]);

        $user = Tracer_answer::where('alumni_id', $request->id)->first();
        $user->hubungan = $request->hubungan;
        $user->save();
        return 'anda telah mengisi soal 5';
    }

    //soal 6


    public function soal6Process(Request $request)
    {
        $request->validate([
            'gaji_utama' => 'required',
            'lembur' => 'required',
            'gaji_lain' => 'required'
        ]);

        $user = Tracer_answer::where('alumni_id', $request->id)->first();
        $user->gaji_utama = $request->gaji_utama;
        $user->lembur = $request->lembur;
        $user->gaji_lain = $request->gaji_lain;
        $user->save();
        return 'anda telah mengisi soal6';
    }

    public function soal7Process(Request $request)
    {
        if ($request->terdampak == 'ya') {
            $request->validate([
                'terdampak' => 'required',
                'dampak_corona' => 'required'
            ]);
        } else {
            $request->validate([
                'terdampak' => 'required'
            ]);
        }


        $user = Tracer_answer::where('alumni_id', $request->id)->first();
        $user->terdampak = $request->terdampak;
        $user->dampak_corona = $request->akibat;
        $user->save();

        return 'anda telah menjawab soal 7';
    }

    public function soal8Process(Request $request)
    {
        //mengambil data nisn

        //pengechekan data apakah user akan mengupdate data
        if (Punya_Prestasi::where('id_nisn', $request->id)->first() == !null and Prestasi::where('alumni_id', $request->id)->first() == !null) {
            // melakukan update data kedalam tabel prestasi
            $user = Prestasi::where('alumni_id', $request->id)->first();
            $user->nama_prestasi = $request->nama_prestasi;
            $user->juara = $request->juara;
            $user->tingkat =  $request->tingkat;
            $user->save();

            // melakukan update data juga pada tabel data
            $data = Punya_Prestasi::where('id_nisn', $request->id)->first();
            $data->peran = $request->peran;
            $data->save();

            //memberikan status pada tabel tracer answer bahwa benar sudah selesai
            $data =  Tracer_answer::where('alumni_id', $request->id)->first();
            $data->status = 'finised';
            $data->save();
            return 'soal 8 berhasil dijawab';
        } else {
            $user = new Prestasi();
            $user->alumni_id =  $request->id;
            $user->nama_prestasi = $request->nama_prestasi;
            $user->juara = $request->juara;
            $user->tingkat =  $request->tingkat;
            $user->save();

            //setelah melakuakan pengisian presentasi maak prestasi akan dimasukan prestasi yang dimiliki
            $user->id;
            $data = new Punya_Prestasi();
            $data->id_nisn = $request->id;
            $data->id_prestasi = $user->id;;
            $data->peran = $request->peran;
            $data->save();
            $id_punya_prestasi = $data->id;

            //memberikan status pada tabel tracer answer bahwa benar sudah selesai
            $data =  Tracer_answer::where('alumni_id', $request->id)->first();
            $data->id_punya_prestasi = $id_punya_prestasi;  
            $data->status = 'finised';
            $data->save();

            //masukan hubunga data prrestasi dengan nisn pada tabel punya transaksi
            return 'soal 8 berhasil dijawab';
        }
    }
    public function backHome(Request $request)
    {

        $request->session()->forget('key');
        return view('landing');
    }
}
