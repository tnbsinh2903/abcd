<?php

use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\ThuongMaiController;
use App\Http\Controllers\Usercontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->group(function () {
    Route::get('/users', [NhanVienController::class, 'findAll'])->name('user.findAll');
    Route::get('/users/create', [NhanVienController::class, 'index'])->name('user.index');
    Route::post('/users/create', [NhanVienController::class, 'create'])->name('user.create');
    Route::post('/users/update/{id}', [NhanVienController::class, 'update'])->name('user.update');
    Route::delete('/users/delete/{id}', [NhanVienController::class, 'delete'])->name('user.delete');
    Route::post('/users/login', [UserController::class, 'login'])->name('user.login');
    Route::post('/users/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/thuongmai', [ThuongMaiController::class, 'getAll'])->name('thuongmai.getAll');
    Route::post('/thuongmai/upload', [ThuongMaiController::class, 'uploadFile'])->name('thuongmai.uploadFile');
    Route::put('/thuongmai/update', [ThuongMaiController::class, 'update'])->name('thuongmai.update');
    Route::post('/thuongmai/delete', [ThuongMaiController::class, 'delete'])->name('thuongmai.delete');
    // Route::get('/thuongmai', [ThuongMaiController::class, 'search'])->name('thuongmai.search');
});
