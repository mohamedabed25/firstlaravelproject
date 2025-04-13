<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Roles\RoleController;




use App\Http\Controllers\Auth\AuthController;

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register.form'); // لعرض نموذج التسجيل
Route::post('register', [AuthController::class, 'register'])->name('register'); // لمعالجة التسجيل بعد إرسال البيانات
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form'); // لعرض نموذج تسجيل الدخول
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->resource('users', UserController::class);
Route::middleware('auth')->resource('roles', RoleController::class);


Route::get('/master', function () {
    return view('admin.layout.master');
});


Route::get('/', function () {
    return view('home');
})->name('home');

