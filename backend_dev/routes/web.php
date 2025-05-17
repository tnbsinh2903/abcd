<?php

use App\Http\Controllers\Usercontroller;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/users/create', [Usercontroller::class, 'create'])->name('user.create');
Route::get('/users/create', [Usercontroller::class, 'index'])->name('user.index');
