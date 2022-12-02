<?php

namespace App\Http\Controllers\auth\API;
use App\Models\Jurusan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class jurusanController extends Controller
{
    
    public function ProcessAddJurusan(Request $request)
    {
        $request->validate([
            'kode' => 'required|max:5',
            'jurusan' => 'required'
        ]);

        $data = new jurusan();
        $data->kode_jurusan = $request->kode;
        $data->nama_jurusan =  $request->jurusan;
        $data->save();

        return redirect()->route('view-jurusan');
    }


    public function updtJurusan(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|max:5',
            'jurusan' => 'required'
        ]);

        $data = jurusan::find($id);
        $data->kode_jurusan = $request->kode;
        $data->nama_jurusan =  $request->jurusan;
        $data->save();

        return redirect()->route('view-jurusan');
    }

    //trace study
    public function loginProcess(Request $request)
    {
        
        //cek apakah user pernah mendaftar di tracer ?
       if(alumni::where('nisn',$request->nisn)->first()==!null) {
        $request->validate([
            'nisn' => 'required|min:10'
        ]);
        
        //cek user apakah user pernah melakukan finis question
        if(Tracer_answer::select('status')->where('nisn')->first()=='finised'){
            $user = alumni::where('nisn',$request->nisn)->first();

            return redirect()->route('soal1',['nisn' => $user->nisn])->with('succes','Hello Selamat Datang Kembali, Silahkan Mengisi Pertayaan, Usahakan Sampai selesai');
           }else{
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
        
        
        
        return redirect()->route('soal1',['nisn' => $data->nisn])->with('succes','selamat anda pendaftar baru, data andah kami simpan !!');
       }else{
        return redirect()->route('login-alumni')->withErrors("Error Request Masukan Sesuai Form");
       }
       
    }



    //soal 1
    public function viewSoal1($nisn){
    
        $user = alumni::where('nisn',$nisn)->first();
        return view('trace/page',['user'=> $user]);
    }

    public function soal1Process(Request $request){
        
        if(Tracer_answer::where('nisn',$request->nisn)->first()==!null) {
             $user = Tracer_answer::where('nisn',$request->nisn)->first();
             $user->akademi = $request->akademi;
             $user->save(); 
             return redirect()->route('soal2',['nisn'=>$request->nisn]); 
        }else if (Tracer_answer::where('nisn',$request->nisn)->first()==null){
            $request->validate([
                'akademi' => 'required',
            ]);

            $user = new Tracer_answer();
            $user->id_user= $request->id_user;
            $user->nisn = $request->nisn;
            $user->akademi = $request->akademi;
            $user->save();
            return redirect()->route('soal2',['nisn'=>$request->nisn]); 
        }
    }

    //soal 2
    public function viewSoal2($nisn)
    {
        $user = alumni::where('nisn', $nisn)->first();
        return view('trace/soal2', ['user' => $user]);
    }

    public function soal2Process(Request $request)
    {

        $user = Tracer_answer::where('nisn', $request->nisn)->first();
        $user->kategori = $request->kategori;
        $user->save();

        return redirect()->route('soal3',['nisn'=>$request->nisn]);
        
     
    }

        //soal 3
        public function viewSoal3($nisn){
            $user = alumni::where('nisn',$nisn)->first();
            return view('trace/soal3',['user'=>$user]);
        }
    
        public function soal3Process(Request $request){
            $request->validate([
                'tema'=>'required'
            ]);
            $user = Tracer_answer::where('nisn',$request->nisn)->first();
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
            return redirect()->route('soal4',['nisn' => $user->nisn]);
            
            
            
        }



    //soal4

    public function viewSoal4($nisn){
        $user = alumni::where('nisn',$nisn)->first();
        return view('trace/soal4',['user'=>$user]);
    }

    public function soal4Process(Request $request)
    {

        $user = Tracer_answer::where('nisn', $request->nisn)->first();
        $user->tingkat = $request->tingkat;
        $user->save(); 
        return redirect()->route('soal5',$request->nisn);
        
        
        
    }

    //soal5
        
        public function viewSoal5($nisn){
            $user = alumni::where('nisn',$nisn)->first();

            return view('trace/soal5',['user'=>$user]);
        }
    
        public function soal5Process(Request $request){
            $user = Tracer_answer::where('nisn',$request->nisn)->first();
            $user->hubungan = $request->hubungan;
            $user->save(); 
            return redirect()->route('soal6',['nisn'=>$request->nisn]);
            
            
            
        }

            //soal 6

    public function viewSoal6($nisn){
        $user = alumni::where('nisn',$nisn)->first();

        return view('trace/soal6',['user'=>$user]);

     
    }

    public function soal6Process(Request $request){
        $user = Tracer_answer::where('nisn',$request->nisn)->first();
        $user->gaji_utama = $request->gaji_utama;
        $user->lembur = $request->lembur;
        $user->gaji_lain = $request->gaji_lain;
        $user->save(); 
        return redirect()->route('soal7',['nisn'=>$request->nisn]);
        
        
        
    }

        //soal 7
        public function viewSoal7($nisn){
            $user = alumni::where('nisn',$nisn)->first();

            return view('trace/soal7',['user'=>$user]);

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
