<?php

namespace App\Http\Controllers\API\jurusan;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class jurusanController extends Controller
{
    public function getAll()
    {
        $data = Jurusan::orderBy('id', 'desc')->get();

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_jurusan' => 'required|unique:jurusans|max:5',
            'nama_jurusan' => 'required',
        ]);

        $data = new Jurusan;
        $data->kode_jurusan = $request->kode_jurusan;
        $data->nama_jurusan = $request->nama_jurusan;
        $data->save();

        return response()->json($data, 201);
    }

    public function update(Request $request)
    {
        $validateData = $request->validate([
            'kode_jurusan' => 'required|max:5',
            'nama_jurusan' => 'required',
        ]);

        $data = Jurusan::where('id', '=', $request->id)->first();
        $data->kode_jurusan = $request->kode_jurusan;
        $data->nama_jurusan = $request->nama_jurusan;
        $data->save();

        return response()->json($data, 201);
    }

    public function destroye(Request $request)
    {
        $data = Jurusan::where('id', '=', $request->id)->first();

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
