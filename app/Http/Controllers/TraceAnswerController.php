<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tracer_answer;


class TraceAnswerController extends Controller
{
     public function answerSetUp ($key, $input, $kolom){
      

        $result =  Tracer_answer::where('alumni_id',$key)->first();
        $result->$kolom = $input;

        $notify = $result->save();
        return $notify;

     }

     // fungsi menambahkan data baru pada tabel trace answer

     public function setStartTrace ($key){
      $result =  Tracer_answer::create([
         'alumni_id' => $key->id,
         'nisn' => $key->nisn
      ]);

      return $result;
     }
}
