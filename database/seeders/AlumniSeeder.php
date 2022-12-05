<?php

namespace Database\Seeders;

use App\Models\alumni;
use Illuminate\Database\Seeder;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        alumni::create([
            'jurusan_id' => 1,
            'nisn' => 1234567890,
            'nik' => 1234567890123456,
            'nis' => 1234,
            'name' => 'Mohamad Agus Firmansah',
            'email' => 'firman@gmail.com',
            'nomer' => 62864738906472,
            'tahun_lulus' => 2020,
        ]);
        alumni::create([
            'jurusan_id' => 2,
            'nisn' => 1234567899,
            'nik' => 1234567890123465,
            'nis' => 1243,
            'name' => 'Wahyu Sahri Ramadhan',
            'email' => 'wahyu@gmail.com',
            'nomer' => 6286473826472,
            'tahun_lulus' => 2020,
        ]);
        alumni::create([
            'jurusan_id' => 3,
            'nisn' => 1234567888,
            'nik' => 1234567890123444,
            'nis' => 1222,
            'name' => 'Jaki Daniyudin',
            'email' => 'jaki@gmail.com',
            'nomer' => 6286473826472,
            'tahun_lulus' => 2020,
        ]);
    }
}
