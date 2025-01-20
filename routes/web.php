<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLinkController;
use App\Http\Controllers\UserQrCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/qrcode', function () {
    return view('qrcode.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('links', UserLinkController::class);

Route::resource('qrcode', UserQrCodeController::class);
Route::post('links/uploadImage', [UserLinkController::class, 'uploadImage'])->name('links.uploadImage');

// Links page
Route::get('/users/{user}', [UserController::class, 'showLinks'])->name('users.showLinks');

require __DIR__.'/auth.php';
