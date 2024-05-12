<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('auth/create-token', [AuthController::class, 'createToken'])
        ->name('create-token');
    Route::middleware('auth:sanctum')->group(function () {

        Route::prefix('auth')->group(function () {
            Route::get('/list-tokens', [AuthController::class, 'listTokens'])->name('list-tokens');
            Route::delete('/revoke-token', [AuthController::class, 'revokeToken'])->name('revoke-token');
        });

        Route::prefix('customers')->name('customers.')->group(function () {
            Route::post('/create', [CustomerController::class, 'store'])->name('store');
            Route::get('/', [CustomerController::class, 'search'])->name('customers.search');
            Route::put('/{id}/update', [CustomerController::class, 'update'])->name('customers.update');
            Route::delete('/destroy', [CustomerController::class, 'destroy'])->name('customers.destroy');
        });
    });
});
