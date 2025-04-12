<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::resource('users', UserController::class);

Route::get('/master', function () {
    return view('admin.layout.master');
});


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/user', function () {
    return view('user');
})->name('user');

