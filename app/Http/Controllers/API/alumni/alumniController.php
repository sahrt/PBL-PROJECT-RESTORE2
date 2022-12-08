<?php

namespace App\Http\Controllers\API\alumni;

use App\Models\alumni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class alumniController extends Controller
{
    public function getAll()
    {
        $data = alumni::all()->orderBy('id', 'desc');

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'jurusan_id' => 'required',
            'nisn' => 'required|min:10',
            'nik' => 'required:min:16',
            'nis' => 'required:min4',
            'name' => 'required',
            'email' => 'required|unique',
            'nomer' => 'required|min:10',
            'tahun_lulus' => 'required',
        ]);

        $data = new alumni;
        $data->jurusan_id = $request->jurusan_id;
        $data->nisn = $request->nisn;
        $data->nik = $request->nik;
        $data->nis = $request->nis;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->nomer = $request->nomer;
        $data->tahun_lulus = $request->tahun_lulus;
        $data->save();

        return response()->json($data, 201);
    }

    public function update(Request $request)
    {
        $validateData = $request->validate([
            'jurusan_id' => 'required',
            'nisn' => 'required|min:10',
            'nik' => 'required:min:16',
            'nis' => 'required:min4',
            'name' => 'required',
            'email' => 'required|unique',
            'nomer' => 'required|min:10',
            'tahun_lulus' => 'required',
        ]);

        $data = alumni::where('id', '=', $request->email)->first();
        $data->jurusan_id = $request->jurusan_id;
        $data->nisn = $request->nisn;
        $data->nik = $request->nik;
        $data->nis = $request->nis;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->nomer = $request->nomer;
        $data->tahun_lulus = $request->tahun_lulus;
        $data->save();

        return response()->json($data, 201);
    }

    public function destroye(Request $request)
    {
        $data = alumni::where('id', '=', $request->email)->first();

        if (!empty($data)) {
            $data->delete();
            return response()->json($data, 200);
        } else {
            return response()->json([
                'error' => 'data tidak ditemukan'
            ], 404);
        }
    }
}
