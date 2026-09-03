<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\AuthController;

Route::get('/', fn () => auth()->check() ? to_route('surat.index') : response()->view('auth.login'))->name('welcome');
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
	Route::resource('surat', SuratController::class)->only(['index', 'create', 'store']);
	Route::post('/surat/{surat}/approve/{level}', [SuratController::class, 'approve'])->name('surat.approve');
	Route::post('/surat/{surat}/reject/{level}', [SuratController::class, 'reject'])->name('surat.reject');
});
