<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;

Route::get('/', fn () => response()->view('welcome'))->name('welcome');
Route::get('/profil-desa', fn () => response()->view('profil-desa'))->name('profil-desa');
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
	Route::resource('surat', SuratController::class)->only(['index', 'create', 'store', 'show']);
	Route::post('/surat/{surat}/approve/{level}', [SuratController::class, 'approve'])->name('surat.approve');
	Route::post('/surat/{surat}/reject/{level}', [SuratController::class, 'reject'])->name('surat.reject');
	Route::get('/notifications/{notification}/read', [NotificationController::class, 'read'])->name('notifications.read');
});
