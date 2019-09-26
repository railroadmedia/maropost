<?php

use Illuminate\Support\Facades\Route;
use Railroad\Railcontent\Controllers\CommentJsonController;
use Railroad\Railcontent\Controllers\CommentLikeJsonController;
use Railroad\Railcontent\Controllers\ContentFieldJsonController;
use Railroad\Railcontent\Controllers\ContentJsonController;
use Railroad\Railcontent\Controllers\ContentLikeJsonController;
use Railroad\Railcontent\Controllers\ContentProgressJsonController;
use Railroad\Railcontent\Controllers\FullTextSearchJsonController;
use Railroad\Railcontent\Controllers\PermissionJsonController;
use Railroad\Railcontent\Controllers\MyListJsonController;
use Railroad\Railcontent\Controllers\ApiJsonController;
use Railroad\Railcontent\Services\ConfigService;

Route::group(
    [
        'prefix' => 'maropost',
        'middleware' => config('maropost.all_routes_middleware'),
    ],
    function () {
        Route::post(
            '/sync-contact/{email}',
            \Railroad\Maropost\Controllers\MaropostController::class . '@contact'
        )
            ->name('maropost.sync-contact');
    }
);