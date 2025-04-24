<?php

/**
 * Routes for exchange module
 **/
use Illuminate\Support\Facades\Route;

Route::prefix('exchange')->group(
    function () {
        Route::get('/latest', [App\Modules\Exchange\Controllers\ExchangeController::class, 'latest']);
    }
);
