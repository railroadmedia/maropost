<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'maropost',
        'middleware' => config('maropost.all_routes_middleware'),
    ],
    function () {
        Route::post(
            '/form/sync-contact',
            \Railroad\Maropost\Controllers\MaropostFormController::class.'@syncContact'
        )
            ->name('maropost.form.sync-contact');
        
        Route::post(
            '/json/sync-contact',
            \Railroad\Maropost\Controllers\MaropostJsonController::class.'@syncContact'
        )
            ->name('maropost.json.sync-contact');
    }
);