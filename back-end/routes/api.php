<?php

use App\Http\Controllers\Post\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

require __DIR__.'/auth.php';

Route::resource('/posts', PostController::class)->only(['index', 'show',]);

Route::resource('/posts', PostController::class)->only(['store', 'update', 'destroy'])
    ->middleware('auth:sanctum');
