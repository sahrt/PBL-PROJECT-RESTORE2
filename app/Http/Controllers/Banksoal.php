<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\bank_soal;
use App\Models\Soal;
use Illuminate\Http\Request;

class Banksoal extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($request)
    {
        // $request->validate([
        //     'soal' => 'require',
        //     'answer1' => 'require',
        //     'answer2' => 'require'
           
        // ]);

        $result = new Soal();
        $result->create($request);
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //karena 1 soal diambil 1 maka 1 page hanya diambil 1 soal dari database
    public function store($skip, $take =1)
    {
        $result= Soal::orderBy('id')->skip($skip)->take($take)->get();
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,  $request)
    {
        $request->validate([
            'soal' => 'require',
            'answer1' => 'require',
            'answer2' => 'require'
        ]);

        $result = Soal::find($id)->get();

        $result->soal = $request->soal;
        $result->answer1 = $request->answer1;
        $result->answer2 = $request->answer2;
        $result->answer3 = $request->answer3;
        $result->answer4 = $request->answer4;

        $notfy = $result->save();

        if (!$notfy) {
            return "edit failed";
        }

        return "edit success";


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Soal::find($id)->get();
        $notfy = $result->destroy();
        if (!$notfy) {
            return "destroy failed";
        }
        return "destroy succes";
        

        
    }
}
