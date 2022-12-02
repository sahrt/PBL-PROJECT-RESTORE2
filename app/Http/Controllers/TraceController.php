<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\alumni;
use App\Models\Tracer_answer;
use App\Models\Jurusan;
use Illuminate\Http\Request;


class TraceController extends Controller
{
    public function index()
    {
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

    public function login()
    {
        $jurusan['jurusan'] = Jurusan::all();
        return view('trace.login', $jurusan);
    }

    public function loginProcess(Request $request)
    {
        
        //cek apakah user pernah mendaftar di tracer ?
       if(alumni::where('nisn',$request->nisn)->first()==!null) {
        $request->validate([
            'nisn' => 'required|min:10'
        ]);
        
        //cek user apakah user pernah melakukan finis question
        if(Tracer_answer::select('status')->where('nisn')->first()==null){
            $user = alumni::where('nisn',$request->nisn)->first();
            $request->session()->put('nisn',$request->nisn);
            return redirect()->route('viewSoal',['soal'=>'page'])->with('succes','Hello Selamat Datang Kembali, Silahkan Mengisi Pertayaan, Usahakan Sampai selesai');
           }else if(Tracer_answer::select('status')->where('nisn')->first()=='finised'){
            return redirect()->route('login-alumni')->withErrors("Maaf Anda Telah Mengisi");
           }
       }else if (alumni::where('nisn', $request->nisn)->first()==null){
         $request->validate([
            'nisn' => 'required|unique:alumnis|min:10',
            'name' => 'required',
            'email' => 'required|unique:alumnis',
            'nomer' => 'required|unique:alumnis|min:12',
            'jurusan' => 'required',
            'tahun_lulus' => 'required'
        ]);

        $data = new alumni();
        $data->nisn = $request->nisn;
        $data->name =  $request->name;
        $data->email = $request->email;
        $data->nomer = $request->nomer;
        $data->jurusan = $request->jurusan;
        $data->tahun_lulus = $request->tahun_lulus;
        $data->save();
        
        $request->session()->put('nisn',$request->nisn);
        
        return redirect()->route('viewSoal',['soal1'=>'page'])->with('succes','selamat anda pendaftar baru, data andah kami simpan !!');
       }else{
        return redirect()->route('login-alumni')->withErrors("Error Request Masukan Sesuai Form");
       }
       
    }

    //fungsi menampilkan soal
      public function viewSoal(Request $request,$soal){
        $nisn=$request->session()->get('nisn');
        if($nisn == !null){
            $user = alumni::where('nisn',$nisn)->first();

            return view('trace/'.$soal,['user'=>$user]); 
        }else{
           return redirect()->route('login-alumni');
        }

     }



    //soal 1

    public function soal1Process(Request $request){
    $nisn=$request->session()->get('nisn');
        if(Tracer_answer::where('nisn',$nisn)->first()==!null) {
             $user = Tracer_answer::where('nisn',$request->nisn)->first();
             $user->akademi = $request->akademi;
             $user->save(); 
             return redirect()->route('viewSoal',['soal'=>'soal2','nisn'=>$request->nisn]); 
        }else if (Tracer_answer::where('nisn',$nisn)->first()==null){
            $request->validate([
                'akademi' => 'required',
            ]);

            $user = new Tracer_answer();
            $user->id_user= $request->id_user;
            $user->nisn = $request->nisn;
            $user->akademi = $request->akademi;
            $user->save();
            return redirect()->route('viewSoal',['soal'=>'soal2']); 
        }
    }

    //soal 2

    public function soal2Process(Request $request)
    {
        $nisn=$request->session->get('nisn');
        $user = Tracer_answer::where('nisn',$nisn)->first();
        $user->kategori = $request->kategori;
        $user->save();

        return redirect()->route('viewSoal',['soal'=>'soal3']);
        
     
    }

        //soal 3
        public function soal3Process(Request $request){
            $nisn=$request->session->get('nisn');
            $request->validate([
                'tema'=>'required'
            ]);
            $user = Tracer_answer::where('nisn',$nisn)->first();
            $user->tema = $request->tema;
            $user->nama_perusahaan = $request->nama_perusahaan;
            $user->jabatan =$request->jabatan;
            $user->jenis_perusahaan = $request->jenis_perusahaan;
            $user->kota = $request->kota;
            $user->nomer = $request->nomer;
            $user->lesensi = $request->lesensi;
            $user->nama_usaha = $request->name_usaha;
            $user->bidang = $request->bidang;
            $user->sesuai = $request->sesuai;
            $user->save(); 
            return redirect()->route('viewSoal',['soal'=>'soal4']);
            
            
            
        }



    //soal4

    public function soal4Process(Request $request)
    {
        $nisn=$request->session->get('nisn');
        $user = Tracer_answer::where('nisn', $nisn)->first();
        $user->tingkat = $request->tingkat;
        $user->save(); 
        return redirect()->route('viewSoal',['soal'=>'soal5','nisn'=>$request->nisn]);
        
        
        
    }

    //soal5
        public function soal5Process(Request $request){
            $nisn=$request->session->get('nisn');
            $user = Tracer_answer::where('nisn',$nisn)->first();
            $user->hubungan = $request->hubungan;
            $user->save(); 
            return redirect()->route('viewSoal',['soal'=>'soal6','nisn'=>$request->nisn]);
            
            
            
        }

            //soal 6


    public function soal6Process(Request $request){
        $user = Tracer_answer::where('nisn',$request->nisn)->first();
        $user->gaji_utama = $request->gaji_utama;
        $user->lembur = $request->lembur;
        $user->gaji_lain = $request->gaji_lain;
        $user->save(); 
        return redirect()->route('viewSoal',['soal'=>'soal7','nisn'=>$request->nisn]);
        
        
        
    }
    
        public function soal7Process(Request $request){
            $user = Tracer_answer::where('nisn',$request->nisn)->first();
            $user->terdampak = $request->terdampak;
            $user->dampak_corona = $request->akibat;
            $user->status = $request->status;
            $user->save(); 
            
            return redirect()->route('finish');
            
            
            
        }
        public function finish(){
            return view('trace/page-success');
        }
}

    



