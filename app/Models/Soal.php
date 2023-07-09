<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    // memberikan hak akses bagi fungsi create colom apa aja yang dapat disi
    protected $fillable= [
        'soal',
        'answer1',
        'answer2',
        'answer3',
        'answer4'
    ];
}
