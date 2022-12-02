<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\API\jurusanController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('addjurusan',[jurusanController::class, 'ProcessAddJurusan']);
Route::post('ubahjurusan',[jurusanController::class, 'updtJurusan']);



Route::prefix('tracer_study')->group(function () {

    Route::post('login_alumni',[jurusanController::class, 'loginProcess']);
    Route::post('view_soal1',[jurusanController::class, 'viewSoal1']);
    Route::post('ubahjurusan',[jurusanController::class, 'soal1Process']);
    Route::post('ubahjurusan',[jurusanController::class, 'viewSoal2']);
    Route::post('ubahjurusan',[jurusanController::class, 'soal2Process']);
    Route::post('ubahjurusan',[jurusanController::class, 'viewSoal3']);
    Route::post('ubahjurusan',[jurusanController::class, 'soal3Process']);
    Route::post('ubahjurusan',[jurusanController::class, 'viewSoal4']);
    Route::post('ubahjurusan',[jurusanController::class, 'soal4Process']);
    Route::post('ubahjurusan',[jurusanController::class, 'viewSoal5']);
    Route::post('ubahjurusan',[jurusanController::class, 'soal5Process']);
    Route::post('ubahjurusan',[jurusanController::class, 'viewSoal6']);
    Route::post('ubahjurusan',[jurusanController::class, 'soal6Process']);
    Route::post('ubahjurusan',[jurusanController::class, 'viewSoal7']);
    Route::post('ubahjurusan',[jurusanController::class, 'soal7Process']);

});
