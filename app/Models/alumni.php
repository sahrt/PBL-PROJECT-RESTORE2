<?php

namespace App\Models;

use App\Models\Jurusan;
use App\Models\Tracer_answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class alumni extends Model
{
    use HasFactory;

    public function tracer_answer()
    {
        return $this->hasOne(Tracer_answer::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
