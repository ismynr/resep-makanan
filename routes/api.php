<?php

use App\Http\Controllers\Api\BahanApiController;
use App\Http\Controllers\Api\KategoriApiController;
use App\Http\Controllers\Api\ResepApiController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')->group(function() {
    Route::apiResource('bahan', BahanApiController::class);
    Route::apiResource('kategori', KategoriApiController::class);
    Route::apiResource('resep', ResepApiController::class);
});