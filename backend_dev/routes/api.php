<?php

use App\Http\Controllers\KeHoachController;
use App\Http\Controllers\NhanSu\NhanVienController;
use App\Http\Controllers\ThuongMaiController;
use App\Http\Controllers\Usercontroller;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('api')->group(function () {
    Route::get('/nhanvien', [NhanVienController::class, 'findAll'])->name('nhanvien.findAll');
    Route::get('/nhanvien/create', [NhanVienController::class, 'index'])->name('nhanvien.index');
    Route::post('/nhanvien/create', [NhanVienController::class, 'create'])->name('nhanvien.create');
    Route::post('/nhanvien/update/{id}', [NhanVienController::class, 'update'])->name('nhanvien.update');
    Route::delete('/nhanvien/delete/{id}', [NhanVienController::class, 'delete'])->name('nhanvien.delete');
    Route::post('/nhanvien/login', [UserController::class, 'login'])->name('nhanvien.login');
    Route::post('/nhanvien/logout', [UserController::class, 'logout'])->name('nhanvien.logout');
    Route::get('/nhanvien/{id}', [UserController::class, 'show'])->name('nhanvien.show');
    Route::put('/nhanvien/{id}', [UserController::class, 'update'])->name('nhanvien.update');
    Route::delete('/nhanvien/{id}', [UserController::class, 'destroy'])->name('nhanvien.destroy');

    Route::get('/thuongmai', [ThuongMaiController::class, 'getAll'])->name('thuongmai.getAll');
    Route::post('/thuongmai/upload', [ThuongMaiController::class, 'uploadFile'])->name('thuongmai.uploadFile');
    Route::put('/thuongmai/update', [ThuongMaiController::class, 'update'])->name('thuongmai.update');
    Route::post('/thuongmai/delete', [ThuongMaiController::class, 'delete'])->name('thuongmai.delete');
    // Route::get('/thuongmai', [ThuongMaiController::class, 'search'])->name('thuongmai.search');

    Route::get('/kehoach', [KeHoachController::class, 'getDataThuongMai']);
    Route::get('/kehoach/{id}', [KeHoachController::class, 'getDataById']);
    Route::post('/kehoach/create', [KeHoachController::class, 'create']);
});
