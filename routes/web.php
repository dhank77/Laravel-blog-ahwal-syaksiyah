<?php

use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\SuperadminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DataController;
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
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FormulirController;
use App\Http\Controllers\Master\LokasiFileController;
use App\Http\Controllers\ShortController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register' => false]);
Route::get('index/{locale}', [HomeController::class, 'lang']);

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/link/{slug}', [FrontendController::class, 'short'])->name('short');
Route::get('/komplain-pelanggan', [FrontendController::class, 'komplain'])->name('komplain');
Route::post('/store-komplain-pelanggan', [FrontendController::class, 'komplain_store'])->name('komplain.store');
Route::get('/staff-pengajar', [FrontendController::class, 'pengajar'])->name('pengajar');
Route::get('/berita', [FrontendController::class, 'berita'])->name('berita');
Route::get('/pengumuman', [FrontendController::class, 'pengumuman'])->name('pengumuman');
Route::get('/download-file', [FrontendController::class, 'download'])->name('download');
Route::get('/daftar-alumni', [FrontendController::class, 'daftar_alumni'])->name('daftar_alumni');
Route::get('/json_daftar_alumni', [FrontendController::class, 'json_daftar_alumni'])->name('json_daftar_alumni');
Route::get('/data/{slug?}', [FrontendController::class, 'daftar_data'])->name('daftar_data');
Route::get('/surat/{slug?}', [FrontendController::class, 'form_data'])->name('form_data');
Route::get('/filesurat/{slug?}/{id}', [FrontendController::class, 'filesurat'])->name('filesurat');
Route::get('/form/{slug?}', [FrontendController::class, 'isi_form'])->name('isi_form');
Route::get('/cek-form/{slug?}', [FrontendController::class, 'cek_form'])->name('cek_form');
Route::get('/daftar-form/{slug?}', [FrontendController::class, 'daftar_form'])->name('daftar_form');
Route::get('/create-pdf/{id}', [FrontendController::class, 'create_pdf'])->name('create_pdf');
Route::post('/form_data_store/{id}', [FrontendController::class, 'form_data_store'])->name('form_data_store');
Route::post('/isi_form_store/{id}', [FrontendController::class, 'isi_form_store'])->name('isi_form_store');
Route::post('/cek-form-data/{id}', [FrontendController::class, 'cek_form_store'])->name('cek_form_store');
Route::get('/kategori/{kategori}', [FrontendController::class, 'kategori'])->name('kategori');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'root'])->name('root');
    
    //Update User Details
    Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/ubah-password', [HomeController::class, 'passwordIndex'])->name('passwordIndex');
    Route::post('/update-password', [HomeController::class, 'updatePassword'])->name('updatePassword');

    Route::prefix('menu-utama')->middleware('role:admin')->group(function () {
        Route::prefix('menu')->group(function () {
            Route::get('/', [MenuController::class, 'index'])->name('utama.menu.index');
            Route::get('/up/{menu}', [MenuController::class, 'up'])->name('utama.menu.up');
            Route::get('/down/{menu}', [MenuController::class, 'down'])->name('utama.menu.down');
            Route::post('/store', [MenuController::class, 'store'])->name('utama.menu.store');
            Route::get('/delete/{menu}', [MenuController::class, 'delete'])->name('utama.menu.delete');
        });
        Route::prefix('halaman')->group(function () {
            Route::get('/', [HalamanController::class, 'index'])->name('utama.halaman.index');
            Route::get('/json', [HalamanController::class, 'json'])->name('utama.halaman.json');
            Route::get('/add', [HalamanController::class, 'add'])->name('utama.halaman.add');
            Route::get('/edit/{halaman}', [HalamanController::class, 'edit'])->name('utama.halaman.edit');
            Route::post('/store', [HalamanController::class, 'store'])->name('utama.halaman.store');
            Route::get('/delete/{halaman}', [HalamanController::class, 'delete'])->name('utama.halaman.delete');
        });
    });

    Route::prefix('komplain')->middleware('role:admin')->group(function () {
        Route::get('/', [KomplainController::class, 'index'])->name('komplain.index');
        Route::get('/json', [KomplainController::class, 'json'])->name('komplain.json');
        Route::get('/download', [KomplainController::class, 'download'])->name('komplain.download');
        Route::get('/delete/{komplain}', [KomplainController::class, 'delete'])->name('komplain.delete');
    });
    Route::prefix('short')->middleware('role:admin')->group(function () {
        Route::get('/', [ShortController::class, 'index'])->name('short.index');
        Route::get('/json', [ShortController::class, 'json'])->name('short.json');
        Route::get('/add', [ShortController::class, 'add'])->name('short.add');
        Route::get('/edit/{short}', [ShortController::class, 'edit'])->name('short.edit');
        Route::post('/store', [ShortController::class, 'store'])->name('short.store');
        Route::get('/delete/{short}', [ShortController::class, 'delete'])->name('short.delete');
    });
    Route::prefix('database-alumni')->middleware('role:admin')->group(function () {
        Route::get('/', [AlumniController::class, 'index'])->name('alumni.index');
        Route::get('/json', [AlumniController::class, 'json'])->name('alumni.json');
        Route::get('/add', [AlumniController::class, 'add'])->name('alumni.add');
        Route::get('/download', [AlumniController::class, 'download'])->name('alumni.download');
        Route::get('/edit/{alumni}', [AlumniController::class, 'edit'])->name('alumni.edit');
        Route::post('/store', [AlumniController::class, 'store'])->name('alumni.store');
        Route::post('/import', [AlumniController::class, 'import'])->name('alumni.import');
        Route::get('/delete/{alumni}', [AlumniController::class, 'delete'])->name('alumni.delete');
    });
    Route::prefix('pengajar')->middleware('role:admin')->group(function () {
        Route::get('/', [PengajarController::class, 'index'])->name('pengajar.index');
        Route::get('/add', [PengajarController::class, 'add'])->name('pengajar.add');
        Route::get('/berkas/{pengajar}', [PengajarController::class, 'berkas'])->name('pengajar.berkas');
        Route::get('/download-berkas/{pengajar}', [PengajarController::class, 'download'])->name('pengajar.download');
        Route::post('/store', [PengajarController::class, 'store'])->name('pengajar.store');
        Route::get('/edit/{pengajar}', [PengajarController::class, 'edit'])->name('pengajar.edit');
        Route::get('/delete/{pengajar}', [PengajarController::class, 'delete'])->name('pengajar.delete');
    });
    Route::prefix('admin-pengumuman')->middleware('role:admin')->group(function () {
        Route::get('/', [PengumumanController::class, 'index'])->name('pengumuman.index');
        Route::get('/json', [PengumumanController::class, 'json'])->name('pengumuman.json');
        Route::get('/add', [PengumumanController::class, 'add'])->name('pengumuman.add');
        Route::post('/store', [PengumumanController::class, 'store'])->name('pengumuman.store');
        Route::get('/edit/{pengumuman}', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
        Route::get('/delete/{pengumuman}', [PengumumanController::class, 'delete'])->name('pengumuman.delete');
    });

    Route::prefix('download')->middleware('role:admin')->group(function () {
        Route::get('/', [DownloadController::class, 'index'])->name('download.index');
        Route::get('/add', [DownloadController::class, 'add'])->name('download.add');
        Route::get('/edit/{download}', [DownloadController::class, 'edit'])->name('download.edit');
        Route::post('/store', [DownloadController::class, 'store'])->name('download.store');
        Route::get('/delete/{download}', [DownloadController::class, 'delete'])->name('download.delete');
    });
    Route::prefix('berkas')->middleware('role:admin')->group(function () {
        Route::get('/', [BerkasController::class, 'index'])->name('berkas.index');
        Route::get('/add', [BerkasController::class, 'add'])->name('berkas.add');
        Route::get('/json', [BerkasController::class, 'json'])->name('berkas.json');
        Route::get('/edit/{download}', [BerkasController::class, 'edit'])->name('berkas.edit');
        Route::post('/store', [BerkasController::class, 'store'])->name('berkas.store');
        Route::get('/delete/{download}', [BerkasController::class, 'delete'])->name('berkas.delete');
    });
    Route::prefix('persuratan')->middleware('role:admin')->group(function () {
        Route::get('/', [DataController::class, 'index'])->name('persuratan.index');
        Route::get('/add', [DataController::class, 'add'])->name('persuratan.add');
        Route::get('/edit/{data}', [DataController::class, 'edit'])->name('persuratan.edit');
        Route::post('/store', [DataController::class, 'store'])->name('persuratan.store');
        Route::get('/delete/{data}', [DataController::class, 'delete'])->name('persuratan.delete');

        Route::get('/surat/{data}', [DataController::class, 'surat'])->name('persuratan.surat');
        Route::get('/param/{data}', [DataController::class, 'param'])->name('persuratan.param');
        Route::get('/param_edit/{data}/{dataDetail}', [DataController::class, 'param_edit'])->name('persuratan.param_edit');
        Route::post('/param_store', [DataController::class, 'param_store'])->name('persuratan.param_store');
        Route::post('/import', [DataController::class, 'import'])->name('persuratan.import');
        Route::get('/param_delete/{dataDetail}', [DataController::class, 'param_delete'])->name('persuratan.param_delete');
        Route::get('/download/{id}', [DataController::class, 'download'])->name('persuratan.download');
    });
    Route::prefix('formulir')->middleware('role:admin')->group(function () {
        Route::get('/', [FormulirController::class, 'index'])->name('formulir.index');
        Route::get('/add', [FormulirController::class, 'add'])->name('formulir.add');
        Route::get('/json', [FormulirController::class, 'json'])->name('formulir.json');
        Route::get('/edit/{formulir}', [FormulirController::class, 'edit'])->name('formulir.edit');
        Route::post('/store', [FormulirController::class, 'store'])->name('formulir.store');
        Route::get('/delete/{formulir}', [FormulirController::class, 'delete'])->name('formulir.delete');
        Route::get('/detail/{formulir}', [FormulirController::class, 'detail'])->name('formulir.detail');

        Route::get('/formulir-detail-add/{formulir}', [FormulirController::class, 'detail_add'])->name('formulir.detail_add');
        Route::post('/formulir-detail-store/{formulir}', [FormulirController::class, 'detail_store'])->name('formulir.detail_store');
        Route::get('/formulir-detail-edit/{formulir}/{formulirDetail}', [FormulirController::class, 'detail_edit'])->name('formulir.detail_edit');
        Route::get('/formulir-detail-delete/{formulir}/{formulirDetail}', [FormulirController::class, 'detail_delete'])->name('formulir.detail_delete');

        Route::get('/download_file/{formulir}', [FormulirController::class, 'download_file'])->name('formulir.download_file');
        Route::get('/download_xls/{formulir}', [FormulirController::class, 'download_xls'])->name('formulir.download_xls');
    });
    Route::prefix('lokasi-file')->middleware('role:admin')->group(function () {
        Route::get('/', [LokasiFileController::class, 'index'])->name('lokasiFile.index');
        Route::get('/add', [LokasiFileController::class, 'add'])->name('lokasiFile.add');
        Route::get('/edit/{lokasiFile}', [LokasiFileController::class, 'edit'])->name('lokasiFile.edit');
        Route::post('/store', [LokasiFileController::class, 'store'])->name('lokasiFile.store');
        Route::get('/delete/{lokasiFile}', [LokasiFileController::class, 'delete'])->name('lokasiFile.delete');
        Route::get('/lihat/{lokasiFile}', [LokasiFileController::class, 'lihat'])->name('lokasiFile.lihat');
        Route::get('/download/{lokasiFile}', [LokasiFileController::class, 'download'])->name('lokasiFile.download');
    });
    
    Route::prefix('artikel')->group(function () {
        Route::prefix('data')->middleware('role:admin|publisher')->group(function () {
            Route::get('/', [ArtikelController::class, 'index'])->name('artikel.artikel.index');
            Route::get('/json', [ArtikelController::class, 'json'])->name('artikel.artikel.json');
            Route::get('/add', [ArtikelController::class, 'add'])->name('artikel.artikel.add');
            Route::get('/edit/{artikel}', [ArtikelController::class, 'edit'])->name('artikel.artikel.edit');
            Route::post('/store', [ArtikelController::class, 'store'])->name('artikel.artikel.store');
            Route::get('/delete/{artikel}', [ArtikelController::class, 'delete'])->name('artikel.artikel.delete');
        });
        Route::prefix('kategori')->middleware('role:admin')->group(function () {
            Route::get('/', [KategoriController::class, 'index'])->name('artikel.kategori.index');
            Route::get('/add', [KategoriController::class, 'add'])->name('artikel.kategori.add');
            Route::get('/edit/{kategori}', [KategoriController::class, 'edit'])->name('artikel.kategori.edit');
            Route::post('/store', [KategoriController::class, 'store'])->name('artikel.kategori.store');
            Route::get('/delete/{kategori}', [KategoriController::class, 'delete'])->name('artikel.kategori.delete');
        });
    });
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::prefix('publisher')->group(function () {
            Route::get('/', [PublisherController::class, 'index'])->name('admin.publisher.index');
            Route::get('/add', [PublisherController::class, 'add'])->name('admin.publisher.add');
            Route::get('/reset/{user}', [PublisherController::class, 'reset'])->name('admin.publisher.reset');
            Route::get('/edit/{user}', [PublisherController::class, 'edit'])->name('admin.publisher.edit');
            Route::post('/store', [PublisherController::class, 'store'])->name('admin.publisher.store');
            Route::get('/delete/{user}', [PublisherController::class, 'delete'])->name('admin.publisher.delete');
        });
        Route::prefix('super')->group(function () {
            Route::get('/', [SuperadminController::class, 'index'])->name('admin.super.index');
            Route::get('/add', [SuperadminController::class, 'add'])->name('admin.super.add');
            Route::get('/reset/{user}', [SuperadminController::class, 'reset'])->name('admin.super.reset');
            Route::get('/edit/{user}', [SuperadminController::class, 'edit'])->name('admin.super.edit');
            Route::post('/store', [SuperadminController::class, 'store'])->name('admin.super.store');
            Route::get('/delete/{user}', [SuperadminController::class, 'delete'])->name('admin.super.delete');
        });
    });
    Route::prefix('setting')->middleware('role:admin')->group(function () {
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