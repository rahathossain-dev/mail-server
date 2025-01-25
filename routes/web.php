<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\GmailController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SendController;
use App\Http\Controllers\ServerMailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::prefix('users')->group(function () {
    Route::name('user.')->group(function () {
        Route::get('/all', [UserController::class, 'all'])->name('all');
        Route::get('/add', [UserController::class, 'addPage'])->name('add');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::get('/email', [SendController::class, 'email'])->name('email');
        Route::post('/send-email', [SendController::class, 'sendEmail'])->name('sendEmail');
    });
});


Route::prefix('group')->group(function () {
    Route::name('group.')->group(function () {
        Route::get('/all', [EmailController::class, 'allGroup'])->name('all');
        Route::get('/add', [EmailController::class, 'addGroup'])->name('add');
        Route::get('/edit/{id}', [EmailController::class, 'editGroup'])->name('edit');
        Route::post('/store', [EmailController::class, 'storeGroup'])->name('store');
        Route::post('/update', [EmailController::class, 'updateGroup'])->name('update');
        Route::get('/delete/{id}', [EmailController::class, 'deleteGroup'])->name('delete');
        Route::get('/mail/{id}', [EmailController::class, 'groupMailDelete'])->name('groupMailDelete');
    });
});

Route::prefix('server-mail')->group(function () {
    Route::name('server-mail.')->group(function () {
        Route::get('/all', [ServerMailController::class, 'all'])->name('all');
        Route::get('/add', [ServerMailController::class, 'addMail'])->name('add');
        Route::post('/store', [ServerMailController::class, 'storeMail'])->name('store');
        Route::get('/edit/{id}', [ServerMailController::class, 'editMail'])->name('edit');
        Route::post('/update', [ServerMailController::class, 'updateMail'])->name('update');
        Route::post('/delete/{id}', [ServerMailController::class, 'deleteMail'])->name('delete');

        Route::get('/authenticate/{id}', [GmailController::class, 'authenticate'])->name('authenticate');
    });
});

Route::prefix('message')->group(function () {
    Route::name('message.')->group(function () {
        Route::get('/all', [MessageController::class, 'all'])->name('all');
        Route::get('/add', [MessageController::class, 'add'])->name('add');
        Route::post('/store', [MessageController::class, 'store'])->name('store');
    });
});

Route::get('/google/callback', [GmailController::class, 'callback'])->name('callback');
// Route::get('/authenticate/{id}', [GmailController::class, 'authenticate'])->name('authenticate');