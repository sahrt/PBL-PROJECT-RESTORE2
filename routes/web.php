<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TraceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//main page
Route::get('/', [TraceController::class, 'index']);
Route::post('/pilih-user', [TraceController::class, 'choseUser'])->name('pilih-user');
//end main page
Route::get('/login-admin', [AdminController::class, 'index'])->name('login')->middleware('guest');
Route::post('/process-loginAdmin', [AdminController::class, 'processLogin'])->name('loginAdmin');
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/logout', [AdminController::class,  'logout'])->name('logout');

//route kondisi
Route::get('/kondisi-alumni/{kondisi}', [AdminController::class, 'kondisiAlumni'])->name('kondisi-alumni');
//end route kondisi

//route lihat alumni
Route::get('/alumni/{jurusan}', [AdminController::class, 'viewAlumni'])->name('view-alumni');
//end lihat alumni

//route lihat jurusan
Route::get('/jurusan', [AdminController::class, 'viewJurusan'])->name('view-jurusan');
Route::get('/tambah-jurusan', [AdminController::class, 'addJurusan'])->name('add-jurusan');
Route::post('/store-jurusan', [AdminController::class, 'ProcessAddJurusan'])->name('process-add-jurusan');
Route::get('/ubah-jurusan/{id}', [AdminController::class, 'ubahJurusan'])->name('ubah-jurusan');
Route::post('/update-jurusan/{id}', [AdminController::class, 'updtJurusan'])->name('update-jurusan');
Route::get('/delete-jurusan/{id}', [AdminController::class, 'deleteJurusan'])->name('delete-jurusan');
//end lihat jurusan
//route admin

//end route admin

//route alumni
Route::get('/login-alumni', [TraceController::class, 'login'])->name('login-alumni');
Route::post('/process-login', [TraceController::class, 'loginProcess'])->name('loginProcess');
Route::get('/process-login/auth', [TraceController::class, 'authenticateSiswa'])->name('auth-login');
//end routing alumni

//auticae siswa


//memberikan penjelasan umum
//route soal 1
Route::prefix('/tracer-study/qusetion')->group(function () {
    Route::get('/status/{soal?}', [TraceController::class, 'start'])->name('Start');
    Route::get('/{soal}/{id?}', [TraceController::class,  'viewSoal'])->name('viewSoal');
    Route::post('/profile/uploud', [TraceController::class,  'uploudImage'])->name('uploud');

    //view soal controller
    Route::post('/viewsoal/process/', [TraceController::class, 'soalProsess'])->name('viewsoal-proses');
    //soal1
    // Route::post('/soal1/process/', [TraceController::class, 'soal1Process'])->name('soal1-process');

    // //soal2
    // Route::post('/soal2/process', [TraceController::class, 'soal2Process'])->name('soal2-process');
    // //soal3
    // Route::post('/soal3/process', [TraceController::class, 'soal3Process'])->name('soal3-process');
    // //soal4
    // Route::post('/soal4/process', [TraceController::class, 'soal4Process'])->name('soal4-process');
    // //soal5
    // Route::post('/soal5/process', [TraceController::class, 'soal5Process'])->name('soal5-process');
    // //soal6
    // Route::post('/soal6/process', [TraceController::class, 'soal6Process'])->name('soal6-process');
    // //soal7
    // Route::post('/soal7/process', [TraceController::class, 'soal7Process'])->name('soal7-process');
    //soal8
    Route::post('/soal11/process', [TraceController::class, 'soal11Process'])->name('soal11-process');

    Route::get('/finish', [TraceController::class,'finish'])->name('finish');
    //backHome
    Route::get('/back', [TraceController::class, 'home'])->name('home');
});
