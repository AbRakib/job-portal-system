<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('frontend.home');

Route::get('/registration', [AccountController::class, 'registration'])->name('account.registration');
Route::post('/registration/process', [AccountController::class, 'processRegistration'])->name('account.registration.process');
Route::get('/login', [AccountController::class, 'login'])->name('account.login');

Route::get('/contact', [HomeController::class, 'contact'])->name('frontend.contact');