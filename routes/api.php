<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\alumni\alumniController;
use App\Http\Controllers\API\jurusan\jurusanController;
use App\Http\Controllers\API\trace\traceController;
use App\Http\Controllers\app\Http\Controllers\API\trace\traceController as APITraceTraceController;
use App\Http\Controllers\Http\Controllers\API\trace\traceController as TraceTraceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// API CRUD table Alumni
Route::group(['prefix' => 'alumni'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('get_all', [alumniController::class, 'getAll']);
        Route::post('tambah', [alumniController::class, 'store']);
        Route::post('update', [alumniController::class, 'update']);
        Route::post('delete', [alumniController::class, 'destroye']);
    });
});
//end API CRUD table Alumni

// API CRUD table Jurusan
Route::group(['prefix' => 'jurusan'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('get_all', [jurusanController::class, 'getAll']);
        Route::post('tambah', [jurusanController::class, 'store']);
        Route::post('update', [jurusanController::class, 'update']);
        Route::post('delete', [jurusanController::class, 'destroye']);
    });
});
//end API CRUD table Jurusan


// Route::post('addjurusan', [jurusanController::class, 'ProcessAddJurusan']);
// Route::post('ubahjurusan', [jurusanController::class, 'updtJurusan']);
//route alumni
Route::get('login-alumni', [traceController::class, 'login']);
Route::post('loginProcess', [traceController::class, 'loginProcess']);
//end routing alumni

//read data tracer
Route::get('read-data',[traceController::class,'readTrace']);
Route::get('read-prestasi',[traceController::class,'readPrestasi']);
Route::get('read-punya-prestasi',[traceController::class,'readPunyaPrestasi']);

//delete data tracer
Route::post('delete-read-data',[traceController::class,'destroyeTrace']);
Route::post('delete-read-prestasi',[traceController::class,'destroyePrestasi']);
Route::post('delete-read-punya-prestasi',[traceController::class,'destroyePunyaPrestasi']); 






//route soal proseess
    Route::post('soal1Process', [traceController::class, 'soal1Process']);

    //soal2
    Route::post('soal2Process', [traceController::class, 'soal2Process']);
    //soal3
    Route::post('soal3Process', [traceController::class, 'soal3Process']);
    //soal4
    Route::post('soal4Process', [traceController::class, 'soal4Process']);
    //soal5
    Route::post('soal5Process', [traceController::class, 'soal5Process']);
    //soal6
    Route::post('soal6Process', [traceController::class, 'soal6Process']);
    //soal7
    Route::post('soal7Process', [traceController::class, 'soal7Process']);
    //soal8
    Route::post('soal8Process',[traceController::class,'soal8Process']);
    //finish

