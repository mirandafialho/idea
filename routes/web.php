<?php

declare(strict_types=1);

use App\Http\Controllers\Login\DestroyLoginUserController;
use App\Http\Controllers\Login\StartLoginUserController;
use App\Http\Controllers\Login\ViewLoginUserController;
use App\Http\Controllers\Register\CreateRegisteredUserController;
use App\Http\Controllers\Register\StoreRegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::middleware('guest')->group(function () {
    Route::get('/register', CreateRegisteredUserController::class);
    Route::post('/register', StoreRegisteredUserController::class);

    Route::get('/login', ViewLoginUserController::class);
    Route::post('/login', StartLoginUserController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/dash', function () {
        echo '<h1>It works!</h1>';
    });

    Route::delete('/logout', DestroyLoginUserController::class);
});
