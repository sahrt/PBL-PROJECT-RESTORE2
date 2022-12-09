<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\alumni\alumniController;
use App\Http\Controllers\API\jurusan\jurusanController;

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



Route::prefix('tracer_study')->group(function () {

    Route::post('login_alumni', [jurusanController::class, 'loginProcess']);
    Route::post('view_soal1', [jurusanController::class, 'viewSoal1']);
    Route::post('ubahjurusan', [jurusanController::class, 'soal1Process']);
    Route::post('ubahjurusan', [jurusanController::class, 'viewSoal2']);
    Route::post('ubahjurusan', [jurusanController::class, 'soal2Process']);
    Route::post('ubahjurusan', [jurusanController::class, 'viewSoal3']);
    Route::post('ubahjurusan', [jurusanController::class, 'soal3Process']);
    Route::post('ubahjurusan', [jurusanController::class, 'viewSoal4']);
    Route::post('ubahjurusan', [jurusanController::class, 'soal4Process']);
    Route::post('ubahjurusan', [jurusanController::class, 'viewSoal5']);
    Route::post('ubahjurusan', [jurusanController::class, 'soal5Process']);
    Route::post('ubahjurusan', [jurusanController::class, 'viewSoal6']);
    Route::post('ubahjurusan', [jurusanController::class, 'soal6Process']);
    Route::post('ubahjurusan', [jurusanController::class, 'viewSoal7']);
    Route::post('ubahjurusan', [jurusanController::class, 'soal7Process']);
});
