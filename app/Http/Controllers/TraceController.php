<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\alumni;
use App\Models\Tracer_answer;
use App\Models\Jurusan;
use App\Models\Punya_Prestasi;
use App\Models\Prestasi;
use Illuminate\Http\Request;


class TraceController extends Controller
{
    public function index(Request $request)
    {
        $session =  $request->session()->get('key');

        if($session==!null){
            return  redirect()->route('viewSoal',["soal"=>"page"]);

        } 
        return view('landing');
    }

    public function choseUser(Request $request)
    {
        if ($request->tipe == 1) {
            return redirect('/login-alumni');
        } else {
            return redirect('/login-admin');
        }
    }

    public function login(Request $request)
    {
        $session =  $request->session()->get('key');

        if($session==!null){
            return  redirect()->route('viewSoal',["soal"=>"page"]);

        } 
        $jurusan['jurusan'] = Jurusan::all();
        return view('trace.login', $jurusan);
    }

    public function loginProcess(Request $request)
    {

        //nisn apakah terdaftar di database
        $credentials = $request->validate([
            'nisn' => 'required|min:4',
        ]);

        $nisn = alumni::where('nisn', '=', $credentials)->first();
        $nik = alumni::where('nik', '=', $credentials)->first();
        $nis = alumni::where('nis', '=', $credentials)->first();

        if ($nisn) {
            $request->session()->put('key', $nisn);
            return redirect()->route('auth-login');
        } elseif ($nik) {
            $request->session()->put('key', $nik);
            return redirect()->route('auth-login');
        } elseif ($nis) {
            $request->session()->put('key', $nis);
            return redirect()->route('auth-login');
        }

        return back()->with('loginError', 'Data anda Tidak Ditemukan');
    }

    //membuat authtentikasi apakah user benar beanr belum mengisi 

    public function authenticateSiswa (Request $request){
        // pertama kita check dulu apak user benar belum pernah mengisi
        //mengambil data sesiom apakah yang diminta sesuai

        $key = $request->session()->get('key');
     

        //kita check di database apakah ada nimnya
        $finish =  Tracer_answer::select('status')->where('id_user',$key->id)->first();


        //bilah mana $finis  null maka kita membuat pengimputan data baru
        if ($finish == null OR $finish->status == null) {

            return redirect()->route('viewSoal',['soal'=>'page']);

        } 
        if ($finish->status == 'finised'){
      
            //misalnya user melkukan pengisina maka akan dilempar ke menu login kembali 
            //kemudian dilakukan penghapusan session
            $request->session()->forget('key');
            return redirect()->route('login-alumni')->with('loginError', 'Maaf Anda Telah Mengisi');
        }


    }

    //fungsi menampilkan soal
    public function viewSoal(Request $request, $soal)
    {
        $key = $request->session()->get('key');
        if ($key == !null) {
            return view('trace/' . $soal, ['user' => $key]);
        } else {
            return redirect()->route('login-alumni');
        }
    }



    //soal 1

    public function soal1Process(Request $request) {


        $request->validate([
         'akademi' => 'required',
        
        ]);

        $key = $request->session()->get('key');
        if (Tracer_answer::where('id_user', $key->id)->first() == !null) {
            $user = Tracer_answer::where('id_user', $key->id)->first();
            $user->akademi = $request->akademi;
            $user->save();
            return redirect()->route('viewSoal', ['soal' => 'soal2']);
        } else if (Tracer_answer::where('id_user', $key->id)->first() == null) {
            $request->validate([
                'akademi' => 'required',
            ]);

            $user = new Tracer_answer();
            $user->id_user = $request->id_user;
            $user->nisn = $request->nisn;
            $user->akademi = $request->akademi;
            $user->save();
            return redirect()->route('viewSoal', ['soal' => 'soal2']);
        }
    }

    //soal 2

    public function soal2Process(Request $request)
    {
           $request->validate([
                'kategori' => 'required',
        
            ]);
        $key = $request->session()->get('key');
        $user = Tracer_answer::where('id_user', $key->id)->first();
        $user->kategori = $request->kategori;
        $user->save();

        return redirect()->route('viewSoal', ['soal' => 'soal3']);
    }

    //soal 3
    public function soal3Process(Request $request)
    {

        $key = $request->session()->get('key');
        if ($request->tema =="Bekerja (Pegawai)" OR $request->tema == "Bekerja (Pegawai) dan wirausaha") {
      
            $request->validate([

                'tema' => 'required',
                'tingkat' => 'required',
                'nama_perusahaan' => 'required',
                'jabatan' => 'required',
                'jenis_perusahaan' => 'required',
                'kota' => 'required',
                'nomer' => 'required'
            ]);
        } else if ($request->tema== "wirausaha"){
            $request->validate([
                'tema' => 'required',
                'lesensi' => 'required',
                'name_usaha' => 'required',
                'bidang' => 'required',
                'sesuai' => 'required',
          
            ]);
        } else if ($request->tema == 'Tidak Bekerja' OR $request->tema == 'Melanjutkan Kuliah') {
            $request->validate([
                'tema' => 'required',
            ]); 
        }
        
        $user = Tracer_answer::where('id_user', $key->id)->first();
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
        return redirect()->route('viewSoal', ['soal' => 'soal4']);
    }



    //soal4

    public function soal4Process(Request $request)
    {
         $request->validate([
                'tingkat' => 'required',
          
        ]);

        $key = $request->session()->get('key');
        $user = Tracer_answer::where('id_user', $key->id)->first();
        $user->tingkat = $request->tingkat;
        $user->save();
        return redirect()->route('viewSoal', ['soal' => 'soal5']);
    }

    //soal5
    public function soal5Process(Request $request)
    {
        $request->validate([
                'hubungan' => 'required',
          
        ]);

        $key = $request->session()->get('key');
        $user = Tracer_answer::where('id_user', $key->id)->first();
        $user->hubungan = $request->hubungan;
        $user->save();
        return redirect()->route('viewSoal', ['soal' => 'soal6']);
    }

    //soal 6


    public function soal6Process(Request $request)
    {
         $request->validate([
                'gaji_utama' => 'required',
                'lembur' => 'required',
                'gaji_lain' => 'required'
        ]);

        $key = $request->session()->get('key');
        $user = Tracer_answer::where('id_user', $key->id)->first();
        $user->gaji_utama = $request->gaji_utama;
        $user->lembur = $request->lembur;
        $user->gaji_lain = $request->gaji_lain;
        $user->save();
        return redirect()->route('viewSoal', ['soal' => 'soal7']);
    }

    public function soal7Process(Request $request)
    {
        if($request->terdampak == 'ya'){
            $request->validate([
                'terdampak' => 'required',
                'dampak_corona' => 'required'
            ]);
        } else {
            $request->validate([
                'terdampak'=>'required'
            ]);
        }

  
        $key = $request->session()->get('key');
        $user = Tracer_answer::where('id_user', $key->id )->first();
        $user->terdampak = $request->terdampak;
        $user->dampak_corona = $request->akibat;
        $user->save();

        return redirect()->route('viewSoal',['soal'=>'soal8']);
    }

      public function soal8Process(Request $request){
            //mengambil data nisn
            $key = $request->session()->get('key');

            //pengechekan data apakah user akan mengupdate data
        if(Punya_Prestasi::where('id_nisn', $key->id)->first()==!null And Prestasi::where('id_user',$key->id)->first()==!null){
              // melakukan update data kedalam tabel prestasi
              $user = Prestasi::where('id_user',$key->id)->first();
              $user->nama_prestasi = $request->nama_prestasi;
              $user->juara = $request->juara;
              $user->tingkat =  $request->tingkat;
              $user->save();   

              // melakukan update data juga pada tabel data
              $data = Punya_Prestasi::where('id_nisn',$key->id)->first();
              $data->peran = $request->peran;
              $data->save();

              //memberikan status pada tabel tracer answer bahwa benar sudah selesai
              $data =  Tracer_answer::where('id_user', $key->id)->first();
              $data->status = 'finised';
              $data->save();
              return redirect()->route('finish-page');  
        } else {
            $user = new Prestasi();
            $user->id_user =  $key->id;
            $user->nama_prestasi = $request->nama_prestasi;
            $user->juara = $request->juara;
            $user->tingkat =  $request->tingkat;
            $user->save(); 

            //setelah melakuakan pengisian presentasi maak prestasi akan dimasukan prestasi yang dimiliki
            $user->id;
            $data = new Punya_Prestasi();
            $data->id_nisn = $key->id;
            $data->id_prestasi = $user->id;;
            $data->peran = $request->peran;
            $data->save();

              //memberikan status pada tabel tracer answer bahwa benar sudah selesai
            $data =  Tracer_answer::where('id_user', $key->id)->first();
            $data->status = 'finised';
            $data->save();

            //masukan hubunga data prrestasi dengan nisn pada tabel punya transaksi
             return redirect()->route('finish-page');  


        } 
    }
        public function backHome (Request $request){

            $request->session()->forget('key');
            return view('landing');
        }
            
  
}
