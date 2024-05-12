<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('apiResource')) {
    /**
     * Generate the default routes for an API resource.
     */
    function apiResource(bool $softDelete = true, bool $image = false): void
    {
        Route::get('/', 'search');
        Route::post('/create', 'store');
        Route::put('/{id}/update', 'update');
        Route::delete('/destroy', 'destroy');

        if ($image) {
            Route::post('{id}/upload-photo', 'storeImage');
            Route::get('{id}/photo', 'getImage');
            Route::get('{id}/photo', 'getImage');
        }


        if ($softDelete) {
            Route::patch('/restore', 'restore');
        }
    }
}
