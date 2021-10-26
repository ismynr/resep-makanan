<?php

use App\Http\Controllers\BahanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ResepController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('resep.index');
})->name('/');

Route::get('/home', function () {
    return redirect()->route('resep.index');
})->name('home');
Route::resource('bahan', BahanController::class)->except(['create', 'store', 'show']);
Route::resource('kategori', KategoriController::class)->except(['show']);
Route::resource('resep', ResepController::class);
