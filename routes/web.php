<?php

use App\Http\Controllers\GmailController;
use App\Http\Controllers\SendController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('user.all');
});

Route::prefix('users')->group(function () {
    Route::name('user.')->group(function () {
        Route::get('/all', [UserController::class, 'all'])->name('all');
        Route::get('/add', [UserController::class, 'addPage'])->name('add');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::get('/email', [SendController::class, 'email'])->name('email');
        Route::post('/send-email', [SendController::class, 'sendEmail'])->name('sendEmail');
    });
});

Route::get('/google/callback', [GmailController::class, 'callback'])->name('callback');
Route::get('/authenticate/{id}', [GmailController::class, 'authenticate'])->name('authenticate');