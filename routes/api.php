<?php

use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\BookTypeController;
use App\Http\Controllers\api\DataCountController;
use App\Http\Controllers\api\KelasController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\PeminjamanController;
use App\Http\Controllers\api\SiswaController;
use App\Http\Controllers\SiswaPeminjamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => 'Data Berhasil',
            'nama' => auth()->user()->name
        ], 200);
    });

    Route::post('/logout', [LoginController::class,'logout']);

    Route::resource('/books', BookController::class);
    Route::resource('/booktypes', BookTypeController::class);
    Route::resource('/kelas', KelasController::class);
    Route::resource('/siswa', SiswaController::class);

    Route::get('/peminjaman', [PeminjamanController::class,'index']);
    Route::post('/peminjaman', [PeminjamanController::class,'store']);
    Route::put('/peminjaman', [PeminjamanController::class,'update']);
    Route::delete('/peminjaman/{id}', [PeminjamanController::class,'kembalikan']);

    Route::get('/count', [DataCountController::class,'index']);
});

Route::post('/login', [LoginController::class,'index']);
