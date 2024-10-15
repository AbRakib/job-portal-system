<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('frontend.home');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AccountController::class, 'login'])->name('account.login');
    Route::post('/auth/check', [AccountController::class, 'checkLogin'])->name('account.check.login');
    Route::get('/registration', [AccountController::class, 'registration'])->name('account.registration');
    Route::post('/registration/process', [AccountController::class, 'processRegistration'])->name('account.registration.process');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::post('/update-profile', [AccountController::class, 'updateProfile'])->name('account.update.profile');
    Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
    Route::post('update-profile-pic', [AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');
});

Route::get('/contact', [HomeController::class, 'contact'])->name('frontend.contact');