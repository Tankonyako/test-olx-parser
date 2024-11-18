<?php

use App\Http\Controllers\AdsController;
use App\Http\Middleware\FormatJsonMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdsController::class, 'index']);

Route::group([
	'prefix' => 'olx',
	'middleware' => [FormatJsonMiddleware::class]
], function () {
	Route::post('/add', [AdsController::class, 'addAd']);
	Route::delete('/delete/{listing}', [AdsController::class, 'delete']);
	Route::get('/list', [AdsController::class, 'list']);
});
