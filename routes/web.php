<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Master\KategoriController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();
//Language Translation
Route::get('index/{locale}', [HomeController::class, 'lang']);

Route::get('/', [HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [HomeController::class, 'index'])->name('index');

Route::middleware('auth')->prefix('artikel')->group(function(){
    Route::prefix('data')->group(function(){
        Route::get('/', [ArtikelController::class, 'index'])->name('artikel.artikel.index');
        Route::get('/add', [ArtikelController::class, 'add'])->name('artikel.artikel.add');
        Route::get('/edit/{artikel}', [ArtikelController::class, 'edit'])->name('artikel.artikel.edit');
        Route::post('/store', [ArtikelController::class, 'store'])->name('artikel.artikel.store');
        Route::get('/delete/{artikel}', [ArtikelController::class, 'delete'])->name('artikel.artikel.delete');
    });
    Route::prefix('kategori')->group(function(){
        Route::get('/', [KategoriController::class, 'index'])->name('artikel.kategori.index');
        Route::get('/add', [KategoriController::class, 'add'])->name('artikel.kategori.add');
        Route::get('/edit/{kategori}', [KategoriController::class, 'edit'])->name('artikel.kategori.edit');
        Route::post('/store', [KategoriController::class, 'store'])->name('artikel.kategori.store');
        Route::get('/delete/{kategori}', [KategoriController::class, 'delete'])->name('artikel.kategori.delete');
    });
});

