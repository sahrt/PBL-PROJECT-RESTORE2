<?php

namespace App\Http\Controllers;

use App\Models\alumni;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Models\Tracer_answer;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt($credentials) == true) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Failed! Username atau Password Salah');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function dashboard(Request $request)
    {
        $viewAlumni = alumni::latest()->paginate(5);
        $alumni = alumni::count();
        $bekerja = Tracer_answer::where('tema', 'Bekerja(Pegawai)')->count();
        $wirausaha = Tracer_answer::where('tema', 'Berwirausaha')->count();
        $kuliah = Tracer_answer::where('tema', 'Melanjutkan Kuliah')->count();

        return view('admin.index', [
            'viewAlumni' => $viewAlumni,
            'alumni' => $alumni,
            'bekerja' => $bekerja,
            'wirausaha' => $wirausaha,
            'kuliah' => $kuliah
        ]);
    }

    public function kondisiAlumni($kondisi)
    {
        $alumni = Tracer_answer::where('tema', $kondisi)->paginate(10);
        return view('admin.kondisi.index', ['alumni' => $alumni, 'kondisi' => $kondisi]);
    }

    public function viewAlumni($jurusan)
    {

        $alumni['alumni'] = alumni::where('jurusan_id', $jurusan)->paginate(10);
        $title['title'] = jurusan::where('id', $jurusan)->get();
        return view('admin.alumni.index', $alumni, $title);
    }


    public function ubahAlumni($id)
    {
        $alumni['alumni'] = alumni::find($id);
        return view('admin.jurusan.ubah', $alumni);
    }


    public function updtAlumni(Request $request, $id)
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

    public function viewJurusan()
    {
        $jurusan['jurusan'] = Jurusan::all();
        return view('admin.jurusan.index', $jurusan);
    }

    public function deleteAlumni($id)
    {
        $deleteData = jurusan::find($id);
        $deleteData->delete();
        return redirect()->route('view-jurusan')->with('info', 'Data Berhasil Dihapus');
    }

    public function addJurusan()
    {
        return view('admin.jurusan.tambah');
    }

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

    public function ubahJurusan($id)
    {
        $jurusan['jurusan'] = jurusan::find($id);
        return view('admin.jurusan.ubah', $jurusan);
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

    public function deleteJurusan($id)
    {
        $deleteData = jurusan::find($id);
        $deleteData->delete();
        return redirect()->route('view-jurusan')->with('info', 'Data Berhasil Dihapus');
    }
}
