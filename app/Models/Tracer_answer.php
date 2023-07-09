<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracer_answer extends Model
{
    use HasFactory;

    public function alumni()
    {
        return $this->hasOne(alumni::class);
    }

    protected $fillable= [
        'alumni_id',
        'nisn',
        'soal1',
        'soal2',
        'soal3',
        'soal4',
        'soal5',
        'soal6',
        'soal7',
        'soal8',
        'soal9',
        'soal10',
        'id_punya_prestasi',
        'status'
    ];
}
