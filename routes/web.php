<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomAuthController;


Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function (){
    Route::get('/dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logoout', [CustomAuthController::class, 'logout'])->name('logoutt');
});


Route::middleware('guest')->group(function () {


    Route::get('/registrations', [CustomAuthController::class, 'regis'])->name('regis');
    Route::get('/logins', [CustomAuthController::class, 'login'])->name('logins');

    Route::post('/registration-submit', [CustomAuthController::class, 'registrationSubmit'])->name('registration.submit');
    Route::post('/login-submit', [CustomAuthController::class, 'loginSubmit'])->name('login.submit');
});
