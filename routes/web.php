<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KomplainController;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Master\MenuController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SambutanController;
use App\Http\Controllers\TestimoniController;
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
Auth::routes(['register' => false]);
//Language Translation
Route::get('index/{locale}', [HomeController::class, 'lang']);

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/komplain-pelanggan', [FrontendController::class, 'komplain'])->name('komplain');
Route::post('/store-komplain-pelanggan', [FrontendController::class, 'komplain_store'])->name('komplain.store');
Route::get('/staff-pengajar', [FrontendController::class, 'pengajar'])->name('pengajar');
Route::get('/berita', [FrontendController::class, 'berita'])->name('berita');
Route::get('/pengumuman', [FrontendController::class, 'pengumuman'])->name('pengumuman');
Route::get('/kategori/{kategori}', [FrontendController::class, 'kategori'])->name('kategori');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'root'])->name('root');
    
    //Update User Details
    Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/ubah-password', [HomeController::class, 'passwordIndex'])->name('passwordIndex');
    Route::post('/update-password', [HomeController::class, 'updatePassword'])->name('updatePassword');

    Route::prefix('menu-utama')->group(function () {
        Route::prefix('menu')->group(function () {
            Route::get('/', [MenuController::class, 'index'])->name('utama.menu.index');
            Route::get('/up/{menu}', [MenuController::class, 'up'])->name('utama.menu.up');
            Route::get('/down/{menu}', [MenuController::class, 'down'])->name('utama.menu.down');
            Route::post('/store', [MenuController::class, 'store'])->name('utama.menu.store');
            Route::get('/delete/{menu}', [MenuController::class, 'delete'])->name('utama.menu.delete');
        });
        Route::prefix('halaman')->group(function () {
            Route::get('/', [HalamanController::class, 'index'])->name('utama.halaman.index');
            Route::get('/add', [HalamanController::class, 'add'])->name('utama.halaman.add');
            Route::get('/edit/{halaman}', [HalamanController::class, 'edit'])->name('utama.halaman.edit');
            Route::post('/store', [HalamanController::class, 'store'])->name('utama.halaman.store');
            Route::get('/delete/{halaman}', [HalamanController::class, 'delete'])->name('utama.halaman.delete');
        });
    });

    Route::prefix('komplain')->group(function () {
        Route::get('/', [KomplainController::class, 'index'])->name('komplain.index');
        Route::get('/add', [KomplainController::class, 'add'])->name('komplain.add');
        Route::get('/edit/{komplain}', [KomplainController::class, 'edit'])->name('komplain.edit');
        Route::get('/delete/{komplain}', [KomplainController::class, 'delete'])->name('komplain.delete');
    });
    Route::prefix('pengajar')->group(function () {
        Route::get('/', [PengajarController::class, 'index'])->name('pengajar.index');
        Route::get('/add', [PengajarController::class, 'add'])->name('pengajar.add');
        Route::post('/store', [PengajarController::class, 'store'])->name('pengajar.store');
        Route::get('/edit/{pengajar}', [PengajarController::class, 'edit'])->name('pengajar.edit');
        Route::get('/delete/{pengajar}', [PengajarController::class, 'delete'])->name('pengajar.delete');
    });
    Route::prefix('admin-pengumuman')->group(function () {
        Route::get('/', [PengumumanController::class, 'index'])->name('pengumuman.index');
        Route::get('/add', [PengumumanController::class, 'add'])->name('pengumuman.add');
        Route::post('/store', [PengumumanController::class, 'store'])->name('pengumuman.store');
        Route::get('/edit/{pengumuman}', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
        Route::get('/delete/{pengumuman}', [PengumumanController::class, 'delete'])->name('pengumuman.delete');
    });
    
    Route::prefix('artikel')->group(function () {
        Route::prefix('data')->group(function () {
            Route::get('/', [ArtikelController::class, 'index'])->name('artikel.artikel.index');
            Route::get('/add', [ArtikelController::class, 'add'])->name('artikel.artikel.add');
            Route::get('/edit/{artikel}', [ArtikelController::class, 'edit'])->name('artikel.artikel.edit');
            Route::post('/store', [ArtikelController::class, 'store'])->name('artikel.artikel.store');
            Route::get('/delete/{artikel}', [ArtikelController::class, 'delete'])->name('artikel.artikel.delete');
        });
        Route::prefix('kategori')->group(function () {
            Route::get('/', [KategoriController::class, 'index'])->name('artikel.kategori.index');
            Route::get('/add', [KategoriController::class, 'add'])->name('artikel.kategori.add');
            Route::get('/edit/{kategori}', [KategoriController::class, 'edit'])->name('artikel.kategori.edit');
            Route::post('/store', [KategoriController::class, 'store'])->name('artikel.kategori.store');
            Route::get('/delete/{kategori}', [KategoriController::class, 'delete'])->name('artikel.kategori.delete');
        });
    });
    Route::prefix('setting')->group(function () {
        Route::prefix('banner')->group(function () {
            Route::get('/', [BannerController::class, 'index'])->name('setting.banner.index');
            Route::get('/add', [BannerController::class, 'add'])->name('setting.banner.add');
            Route::get('/edit/{banner}', [BannerController::class, 'edit'])->name('setting.banner.edit');
            Route::post('/store', [BannerController::class, 'store'])->name('setting.banner.store');
            Route::get('/delete/{banner}', [BannerController::class, 'delete'])->name('setting.banner.delete');
        });
        Route::prefix('testimoni')->group(function () {
            Route::get('/', [TestimoniController::class, 'index'])->name('setting.testimoni.index');
            Route::get('/add', [TestimoniController::class, 'add'])->name('setting.testimoni.add');
            Route::get('/edit/{testimoni}', [TestimoniController::class, 'edit'])->name('setting.testimoni.edit');
            Route::post('/store', [TestimoniController::class, 'store'])->name('setting.testimoni.store');
            Route::get('/delete/{testimoni}', [TestimoniController::class, 'delete'])->name('setting.testimoni.delete');
        });
        Route::prefix('sambutan')->group(function () {
            Route::get('/', [SambutanController::class, 'index'])->name('setting.sambutan.index');
            Route::post('/store', [SambutanController::class, 'store'])->name('setting.sambutan.store');
        });
        Route::prefix('footer')->group(function () {
            Route::get('/', [FooterController::class, 'index'])->name('setting.footer.index');
            Route::post('/store', [FooterController::class, 'store'])->name('setting.footer.store');
        });
    });
});

Route::get('/{model}/{slug}', [FrontendController::class, 'post'])->name('post');