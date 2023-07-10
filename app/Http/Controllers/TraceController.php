<?php

namespace App\Http\Controllers;

use App\Jobs\alumni as JobsAlumni;
use App\Models\alumni;
use App\Models\Tracer_answer;
use App\Models\Jurusan;
use App\Models\Punya_Prestasi;
use App\Models\Prestasi;
use App\Models\Soal;
use Illuminate\Http\Request;
use App\Http\Controllers\RedirectResponse;
use PhpParser\Node\Expr\FuncCall;

class TraceController extends Controller
{

    public function index(Request $request)
    {
        $start = $request->session()->forget('start');
        $session =  $request->session()->get('key');


        if ($session == !null and $start == null) {
            $jurusan = $request->session()->get('jurusan');

            return redirect()->route('viewSoal', ['soal' => 'profile', 'user' => $session]);
        }
        return view('trace/login');
    }

    public function choseUser(Request $request)
    {
        $start = $request->session()->forget('start');
        $session =  $request->session()->get('key');


        if ($session == !null and $start == null) {
            $jurusan = $request->session()->get('jurusan');
            return redirect()->route('viewSoal', ['soal' => 'profile', 'user' => $session]);
        }
        if ($request->tipe == 1) {
            return redirect('/login-alumni');
        } else {
            return redirect('/login-admin');
        }
    }

    public function login(Request $request)
    {
        $start = $request->session()->forget('start');
        $session =  $request->session()->get('key');


        if ($session == !null and $start == null) {
            $jurusan = $request->session()->get('jurusan');
            $session->jurusan_id = $jurusan->nama_jurusan;
            return redirect()->route('viewSoal', ['soal' => 'profile', 'user' => $session]);
        }
        $jurusan['jurusan'] = Jurusan::all();
        return view('trace.login', $jurusan);
    }

    public function loginProcess(Request $request)
    {

        //nisn apakah terdaftar di database
        $request = $request->validate([
            'nisn' => 'required|min:4',
        ]);
        
           
        $nisn = alumni::firstWhere('nisn',$request);
        $nik =  alumni::firstWhere('nisn',$request);
        $nis =  alumni::firstWhere('nisn',$request);
       
        if ($nisn) {
            session()->put('key', $nisn);
            return redirect()->route('auth-login');
        } elseif ($nik) {
            session()->put('key', $nik);
            return redirect()->route('auth-login');
        } elseif ($nis) {
            session()->put('key', $nis);
            return redirect()->route('auth-login');
        }

       return back()->with('loginError', 'Data anda Tidak Ditemukan');
    
      

    }

    //membuat authtentikasi apakah user benar beanr belum mengisi 

    public function authenticateSiswa(Request $request)
    {
        
        // pertama kita check dulu apak user benar belum pernah mengisi
        //mengambil data sesiom apakah yang diminta sesuai

        $key = $request->session()->get('key');
       

        //kita check di database apakah ada nimnya
        $finish =  Tracer_answer::select('status')->where('alumni_id', $key->id)->first();

        
        //bilah mana $finis  null maka kita membuat pengimputan data baru
        if ($finish == null or $finish->status == null) {
            $key = $request->session()->get('key');
            $result = Jurusan::where('id', $key->jurusan_id)->first();
            $request->session()->put('jurusan', $result);
           

            return redirect()->route('viewSoal', ['soal' => 'profile']);
        }
        if ($finish->status == 'finised') {

            //misalnya user melkukan pengisina maka akan dilempar ke menu login kembali 
            //kemudian dilakukan penghapusan session
            $request->session()->forget('key');
            return redirect()->route('login-alumni')->with('loginError', 'Maaf Anda Telah Mengisi');
        }
    }
    // public function start(Request $request, $soal)
    // {
    //     $start = $request->session()->get('start');
    //     $key = $request->session()->get('key');
    //     $key = $request->session()->get('key');
    //     if ($key == !null) {
    //         return view('trace/' . $soal, ['user' => $key]);
    //     } else {
    //         return redirect()->route('login-alumni');
    //     }
    //     if ($start == null) {
    //         $start = $request->session()->put('start', 'mulai');
    //         return view('trace/' . $soal, ['user' => $key]);
    //     } else {
    //         return redirect()->route('viewSoal', ['soal' => 'page']);
    //     }
    // }

      //mengambil pertanyaan sesuai dengan no soal
      public function soalList ($id)
      {
          $decript = decrypt($id);
          if ($decript) {
              $skip = $id-1;
              
              $soalChose = new Banksoal();
             $resultSoal =  $soalChose->store($skip);
  
             return $resultSoal;
  
          }
  
      }

    //fungsi menampilkan soal
    public function viewSoal(Request $request, $soal, $id=null)
    {
        
       
        $key = $request->session()->get('key');
        $jurusan = $request->session()->get('jurusan');
       
       
        $resultSoal = null;
        if ($key == !null) { 
            if($id == !null){
                $id = decrypt($id);
                if ($id == 0) {
                    $id=1;
                }
            
                if($id > Soal::all()->count()){
                    return view('trace/prestasi', ['user' => $key,'id'=>$id]);
                }
                //melakukan refresh sesion baru
                //melkukan pengechekan penomoran halaman
                    
                    if ($id) {
                        $skip = $id-1;
                        
                        $soalChose = new Banksoal();
                        $resultSoal =  $soalChose->store($skip);
                    }
            }
            

            $data = alumni::where('id', $key->id)->first();
            $key = $request->session()->put('key',$data);
            $key = $request->session()->get('key');
            return view('trace/' . $soal, ['user' => [$key, $jurusan], 'array_soal'=>$resultSoal,'id'=>$id]);
        } else {
            return redirect()->route('login-alumni');
        }
       
       
    }

    

    public function uploudImage (Request $request){
        $request->validate([
            'image'=>'required',
            'image'=>'image|file|max:2024'
        ]);
        $key = $request->session()->get('key');
        if ($key == !null) {
            if($request->img == null){
                return redirect()->route('viewSoal','profile')->with('danger','foto anda belum diimputkan');
            }
            
            $path = $request->file('image')->store('img_alumni');
            $modal =  alumni::where('id', $key->id)->first();
            $modal->foto =  $path;
            $modal->save();

            return redirect()->route('viewSoal','profile');
        } else {
            return redirect()->route('login-alumni');
        }
    }
    

    public function soalProsess (Request $request){
       
        $request->validate([
            'id' => 'required',
            'soal' => 'required'
        ]);
        //penomoran jawaban dengan mengunakan id soal

        $id = decrypt($request->id);

        $kolom = 'soal'.$id;
        

        //mengambil alumni_id pada sesion
        $keyId =  $request->session()->get('key');
        $setUp =  new TraceAnswerController();
       

        //cek apakah user sudah mengisi soal pertama
        if (Tracer_answer::where('alumni_id', $keyId->id)->first() == !null) {
          
        //jika user ada key id maka dapat dilakukan update sja
            $notfY =  $setUp->answerSetUp($keyId->id, $request->soal, $kolom);

            if(!$notfY){
                //jika gagal maka lempar ke soal 1
               return  redirect()-> route('viewSoal',['soal' => 'viewsoal','id'=> encrypt($id)])->with('warning','create gagal');
              }


        //jika berhasil maka next soal selanjutnya
            $id++;
            return redirect()->route('viewSoal',['soal' => 'viewsoal','id'=> encrypt($id)]);

        }if (Tracer_answer::where('alumni_id', $keyId->id)->first() == null) {

        // jika user tidak dan pertama kali sistem akan membuat baris baru pada tabel

        // dimana semetara semua jawaban pada kolom kita isi dengan value null
            $notfY =  $setUp->setStartTrace($keyId);
            
            

           

            if(!$notfY){
                 //jika gagal maka lempar ke soal 1
                return  redirect()-> route('viewSoal',['soal' => 'viewsoal','id'=> encrypt($id)])->with('warning','create gagal');
            }
        // jika suda maka sistem akan melakukan update
            $notfY =  $setUp->answerSetUp($keyId->id, $request->soal, $kolom);

            if (!$notfY) {
                //jika gagal maka lempat ke soal1

                return  redirect()-> route('viewSoal',['soal' => 'viewsoal','id'=> encrypt($id)])->with('warning','create gagal');
            }

            //jika berhasil maka next soal selanjutnya
            $id++;
            return redirect()->route('viewSoal',['soal' => 'viewsoal','id'=> encrypt($id)]);


        }


    }
  
   


    // //soal 1

    // public function soal1Process(Request $request)
    // {


    //     $request->validate([
    //         'akademi' => 'required',

    //     ]);

    //     $key = $request->session()->get('key');
    //     if (Tracer_answer::where('alumni_id', $key->id)->first() == !null) {
    //         $user = Tracer_answer::where('alumni_id', $key->id)->first();
    //         $user->akademi = $request->akademi;
    //         $user->save();
    //         $data = alumni::where('id', $key->id)->first();
    //         $data->tracer_answer_id = $user->id;
    //         $data->save();
    //         return redirect()->route('viewSoal', ['soal' => 'soal2']);
    //     } else if (Tracer_answer::where('alumni_id', $key->id)->first() == null) {
    //         $request->validate([
    //             'akademi' => 'required',
    //         ]);
    //         $user = new Tracer_answer();
    //         $user->alumni_id = $key->id;
    //         $user->nisn = $key->nisn;
    //         $user->akademi = $request->akademi;
    //         $user->save();
    //         $data = alumni::where('id', $key->id)->first();
    //         $data->tracer_answer_id = $user->id;
    //         $data->save();

    //         return redirect()->route('viewSoal', ['soal' => 'soal2']);
    //     }
    // }

    // //soal 2

    // public function soal2Process(Request $request)
    // {
    //     $request->validate([
    //         'kategori' => 'required',

    //     ]);


    //     $key = $request->session()->get('key');
    //     $user = Tracer_answer::where('alumni_id', $key->id)->first();
    //     $user->kategori = $request->kategori;
    //     $user->save();

    //     return redirect()->route('viewSoal', ['soal' => 'soal3']);
    // }

    // //soal 3
    // public function soal3Process(Request $request)
    // {

    //     $key = $request->session()->get('key');
    //     if ($request->tema == "Bekerja (Pegawai)" or $request->tema == "Bekerja (Pegawai) dan wirausaha") {

    //         $request->validate([

    //             'tema' => 'required',
    //             'nama_perusahaan' => 'required',
    //             'jabatan' => 'required',
    //             'jenis_perusahaan' => 'required',
    //             'kota' => 'required',
    //             'nomer' => 'required'
    //         ]);
    //     } else if ($request->tema == "wirausaha") {
    //         $request->validate([
    //             'tema' => 'required',
    //             'lesensi' => 'required',
    //             'name_usaha' => 'required',
    //             'bidang' => 'required',
    //             'sesuai' => 'required',

    //         ]);
    //     } else if ($request->tema == 'Tidak Bekerja' or $request->tema == 'Melanjutkan Kuliah') {
    //         $request->validate([
    //             'tema' => 'required',
    //         ]);
    //     }

    //     $user = Tracer_answer::where('alumni_id', $key->id)->first();
    //     $user->tema = $request->tema;
    //     $user->nama_perusahaan = $request->nama_perusahaan;
    //     $user->jabatan = $request->jabatan;
    //     $user->jenis_perusahaan = $request->jenis_perusahaan;
    //     $user->kota = $request->kota;
    //     $user->nomer = $request->nomer;
    //     $user->lesensi = $request->lesensi;
    //     $user->nama_usaha = $request->name_usaha;
    //     $user->bidang = $request->bidang;
    //     $user->sesuai = $request->sesuai;
    //     $user->save();
    //     return redirect()->route('viewSoal', ['soal' => 'soal4']);
    // }



    // //soal4

    // public function soal4Process(Request $request)
    // {
    //     $request->validate([
    //         'tingkat' => 'required',

    //     ]);

    //     $key = $request->session()->get('key');
    //     $user = Tracer_answer::where('alumni_id', $key->id)->first();
    //     $user->tingkat = $request->tingkat;
    //     $user->save();
    //     return redirect()->route('viewSoal', ['soal' => 'soal5']);
    // }

    // //soal5
    // public function soal5Process(Request $request)
    // {
    //     $request->validate([
    //         'hubungan' => 'required',

    //     ]);

    //     $key = $request->session()->get('key');
    //     $user = Tracer_answer::where('alumni_id', $key->id)->first();
    //     $user->hubungan = $request->hubungan;
    //     $user->save();
    //     return redirect()->route('viewSoal', ['soal' => 'soal6']);
    // }

    // //soal 6


    // public function soal6Process(Request $request)
    // {
    //     $request->validate([
    //         'gaji_utama' => 'required',
    //         'lembur' => 'required',
    //         'gaji_lain' => 'required'
    //     ]);

    //     $key = $request->session()->get('key');
    //     $user = Tracer_answer::where('alumni_id', $key->id)->first();
    //     $user->gaji_utama = $request->gaji_utama;
    //     $user->lembur = $request->lembur;
    //     $user->gaji_lain = $request->gaji_lain;
    //     $user->save();
    //     return redirect()->route('viewSoal', ['soal' => 'soal7']);
    // }

    // public function soal7Process(Request $request)
    // {
    //     if ($request->terdampak == 'ya') {
    //         $request->validate([
    //             'terdampak' => 'required',
    //             'dampak_corona' => 'required'
    //         ]);
    //     } else {
    //         $request->validate([
    //             'terdampak' => 'required'
    //         ]);
    //     }


    //     $key = $request->session()->get('key');
    //     $user = Tracer_answer::where('alumni_id', $key->id)->first();
    //     $user->terdampak = $request->terdampak;
    //     $user->dampak_corona = $request->dampak_corona;
    //     $user->save();

    //     return redirect()->route('viewSoal', ['soal' => 'soal8']);
    // }

    public function soal11Process(Request $request)
    {
        
       
        //mengambil data nisn
        $key = $request->session()->get('key');


        //pengechekan data apakah user akan mengupdate data
        if (Punya_Prestasi::where('id_nisn', $key->id)->first() == !null and Prestasi::where('alumni_id', $key->id)->first() == !null) {
            // melakukan update data kedalam tabel prestasi
            $user = Prestasi::where('alumni_id', $key->id)->first();
            $user->nama_prestasi = $request->nama_prestasi;
            $user->juara = $request->juara;
            $user->tingkat =  $request->tingkat;
            $user->save();

            // melakukan update data juga pada tabel data
            $data = Punya_Prestasi::where('id_nisn', $key->id)->first();
            $data->peran = $request->peran;
            $data->save();

            //memberikan status pada tabel tracer answer bahwa benar sudah selesai
            $data =  Tracer_answer::where('alumni_id', $key->id)->first();
            $data->status = "finised";
            $data->save();

            $rekap = alumni::where('id', $key->id)->first();
            $rekap->tracer_answer_id = $data->id;
            $rekap->save();

            return redirect()->route('finish');
        } else if (Punya_Prestasi::where('id_nisn', $key->id)->first() == null and Prestasi::where('alumni_id', $key->id)->first() == null) {
            $user = new Prestasi();
            $user->alumni_id =  $key->id;
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
            $id_punya_prestasi = $data->id;

            //memberikan status pada tabel tracer answer bahwa benar sudah selesai
            $data =Tracer_answer::where('alumni_id', $key->id)->first();
            $data->id_punya_prestasi = $id_punya_prestasi;
            $data->status = "finised";
            $data->save();

            $rekap = alumni::where('id', $key->id)->first();
            $rekap->tracer_answer_id = $data->id;
            $rekap->save();

            //masukan hubunga data prrestasi dengan nisn pada tabel punya transaksi
            return redirect()->route('finish');
        }
    }
    public function finish (Request $request){
        $key =  $request->session()->get('key');
        return view('trace.finish',['user'=>$key]);
    }
   
    public function home (Request $request)
    {  
        
        $request->session()->forget('jurusan');
        $request->Session()->forget('start');
        $request->session()->forget('key');
        return redirect()->url('/');
    }
}
