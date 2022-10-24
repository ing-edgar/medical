<?php

namespace App\Services;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

class UserRoute
{
    public static function routes()
    {
        Route::get('users',  [UserController::class, 'index']);
        Route::get('users/{user}',  [UserController::class, 'show']);
        Route::delete('users/{user}',  [UserController::class, 'destroy']);
        Route::post('users',  [UserController::class, 'store']);
        Route::put('users/{user}/update-info',  [UserController::class, 'updateInfo']);
        Route::put('users/{user}/update-pass',  [UserController::class, 'updatePass']);
        Route::post('users/reset-password',  [UserController::class, 'resetPassword']);
    }
}
