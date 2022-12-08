<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jurusan::create([
            'kode_jurusan' => '10111',
            'nama_jurusan' => 'Teknik Komputer Dan Jaringan'
        ]);
        Jurusan::create([
            'kode_jurusan' => '10112',
            'nama_jurusan' => 'Teknik Kendaraan Ringan'
        ]);
        Jurusan::create([
            'kode_jurusan' => '10113',
            'nama_jurusan' => 'Akuntansi'
        ]);
    }
}
