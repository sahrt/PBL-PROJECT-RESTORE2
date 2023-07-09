<?php

namespace Database\Seeders;

use App\Models\bank_soal as ModelsBank_soal;
use App\Models\Soal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('soals')->insert([
        "soal" => "Jelaskan Status Anda Saat Ini ? ",
        "answer1" => "Bekerja (fulltime/part time)",
        'answer2' => "Wiraswasta",
        "answer3" => "Melanjutkan Pendidikan",
        "answer4" => "Tidak berkerja, sedang mencari pekertjaan"
        ]);

        DB::table('soals')->insert([
            "soal" => "Darimanakah sumber biaya studi lanjut anda?",
            "answer1" => "Biaya sendiri",
            'answer2' => "Dibiayai perusahaan",
            "answer3" => "Beasiswa pemerintah",
            "answer4" => "Beasiswa swasta"
        ]);
        DB::table('soals')->insert([
            "soal" => "Apa alasan Anda melanjutkan studi? ",
                "answer1" => "Tuntutan profesi",
                'answer2' => "Kesempatan beasiswa",
                "answer3" => "Prestasi",
                "answer4" => "Belum ada keinginan untuk bekerja"
        ]);
        DB::table('soals')->insert([
            "soal" => "Seberapa erat hubungan bidang studi lanjutan anda dengan kompetensi keahlian anda semasa SMK?",
                "answer1" => "Sangat erat",
                'answer2' => "Erat",
                "answer3" => "Kurang erat",
                "answer4" => "Tidak sama sekali"
        ]);
        DB::table('soals')->insert([
            "soal" => "Pada saat lulus, pada tingkat mana kompetensi PENGEMBANGAN DIRI yang Anda kuasai?",
                "answer1" => "Sangat rendah",
                'answer2' => "Rendah ",
                "answer3" => "Cukup",
                "answer4" => "Tinggi"
        ]);
        DB::table('soals')->insert([
            "soal" => "berapa gaji yang diterima pada saat berkerja? ",
                "answer1" => "500.000-1000.000",
                'answer2' => "1000.000-1500.000",
                "answer3" => " > 1500.000",
                "answer4" => "0"
        ]);

        DB::table('soals')->insert([
            "soal" => "Pada saat bekerja, pada tingkat mana kompetensi KOMUNIKASI yang Anda perlukan dalam pekerjaan ?",
                "answer1" => "Besar",
                'answer2' => "Cukup Besar",
                "answer3" => "Kurang",
                "answer4" => "tidak sama sekali"
        ]);

        DB::table('soals')->insert([
            "soal" => "Menurut anda selama proses praktikum pada saat bersekolah apakah membantu anda dalam perkerjaan maupun perkuliahan ?",
                "answer1" => "iya, berpengaruh",
                'answer2' => "cukup berpengaruh",
                "answer3" => "Kurang berpengaruh",
                "answer4" => "tidak sama sekali"
        ]);

        DB::table('soals')->insert([
            "soal" => "Kapan anda medapatkan perkerjaan maupun berkuliah setelah lulus ?",
                "answer1" => "tahun pertama kelulusan",
                'answer2' => "tahun kedua setelah kelulusan",
                "answer3" => "tahun ketiga setelah kelulusan",
                "answer4" => "tahun kemempat setelah kelulusan"
        ]);

        DB::table('soals')->insert([
            "soal" => "Jenis Perguruhan Tinggi yang kamu masuki ?",
                "answer1" => "Peguruan Tinggi Negeri",
                'answer2' => "Perguruan Tinggi Swasta",
                "answer3" => "lainya",
                "answer4" => "Tidak, saya berkerja"
        ]);

      
     
    }
}
