<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\LoginController;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('public.home');
Route::post('/pengaduan_action', [HomeController::class, 'pengaduan_action'])->name('public.pengaduan_action');

Route::get('admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::get('login', function () { return redirect()->route('admin.login'); })->name('login');
Route::post('admin/login/cek', [LoginController::class, 'cek'])->name('admin.login.cek');
Route::get('admin/login/logout', [LoginController::class, 'logout'])->name('admin.logout');

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\JalanController;
use App\Http\Controllers\Admin\PengelolaController;
use App\Http\Controllers\Admin\TitikController;
use App\Http\Controllers\Admin\CetakController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TahunController;
use App\Http\Controllers\Admin\PejabatController;
use App\Http\Controllers\Admin\TitikjukirController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('home', [AdminHomeController::class, 'index'])->name('home');
    Route::get('peta-json', [AdminHomeController::class, 'peta_json'])->name('peta_json');

    // Users Routes
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/read/{id}', [UserController::class, 'read'])->name('users.read');
    Route::get('users/add', [UserController::class, 'add'])->name('users.add');
    Route::post('users/add_action', [UserController::class, 'add_action'])->name('users.add_action');
    Route::get('users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('users/update_action/{id}', [UserController::class, 'update_action'])->name('users.update_action');
    Route::get('users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    Route::get('users/reset/{id}', [UserController::class, 'reset'])->name('users.reset');

    // Tahun Routes
    Route::get('tahun', [TahunController::class, 'index'])->name('tahun.index');
    Route::get('tahun/read/{id}', [TahunController::class, 'read'])->name('tahun.read');
    Route::get('tahun/add', [TahunController::class, 'add'])->name('tahun.add');
    Route::post('tahun/add_action', [TahunController::class, 'add_action'])->name('tahun.add_action');
    Route::get('tahun/update/{id}', [TahunController::class, 'update'])->name('tahun.update');
    Route::post('tahun/update_action/{id}', [TahunController::class, 'update_action'])->name('tahun.update_action');
    Route::get('tahun/delete/{id}', [TahunController::class, 'delete'])->name('tahun.delete');
    Route::get('tahun/active/{id}', [TahunController::class, 'active'])->name('tahun.active');
    Route::get('tahun/unactive/{id}', [TahunController::class, 'unactive'])->name('tahun.unactive');

    // Pejabat Routes
    Route::get('pejabat', [PejabatController::class, 'index'])->name('pejabat.index');
    Route::get('pejabat/read/{id}', [PejabatController::class, 'read'])->name('pejabat.read');
    Route::get('pejabat/add', [PejabatController::class, 'add'])->name('pejabat.add');
    Route::post('pejabat/add_action', [PejabatController::class, 'add_action'])->name('pejabat.add_action');
    Route::get('pejabat/update/{id}', [PejabatController::class, 'update'])->name('pejabat.update');
    Route::post('pejabat/update_action/{id}', [PejabatController::class, 'update_action'])->name('pejabat.update_action');
    Route::get('pejabat/delete/{id}', [PejabatController::class, 'delete'])->name('pejabat.delete');
    Route::get('pejabat/active/{id}', [PejabatController::class, 'active'])->name('pejabat.active');
    Route::get('pejabat/unactive/{id}', [PejabatController::class, 'unactive'])->name('pejabat.unactive');

    // Pengaduan Routes
    Route::get('pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('pengaduan/read/{id}', [PengaduanController::class, 'read'])->name('pengaduan.read');
    Route::get('pengaduan/delete/{id}', [PengaduanController::class, 'delete'])->name('pengaduan.delete');
    Route::get('pengaduan_jukir', [PengaduanController::class, 'jukir_index'])->name('pengaduan_jukir.index');
    Route::get('pengaduan_jukir/read/{id}', [PengaduanController::class, 'jukir_read'])->name('pengaduan_jukir.read');
    Route::get('pengaduan_jukir/delete/{id}', [PengaduanController::class, 'jukir_delete'])->name('pengaduan_jukir.delete');

    // Cetak SK Routes
    Route::get('cetak/perorangan', [CetakController::class, 'perorangan'])->name('cetak.perorangan');
    Route::get('cetak/perorangan_read/{id}', [CetakController::class, 'perorangan_read'])->name('cetak.perorangan_read');
    Route::get('cetak/perorangan_add', [CetakController::class, 'perorangan_add'])->name('cetak.perorangan_add');
    Route::post('cetak/perorangan_add_action', [CetakController::class, 'perorangan_add_action'])->name('cetak.perorangan_add_action');
    Route::get('cetak/perorangan_update/{id}', [CetakController::class, 'perorangan_update'])->name('cetak.perorangan_update');
    Route::post('cetak/perorangan_update_action/{id}', [CetakController::class, 'perorangan_update_action'])->name('cetak.perorangan_update_action');
    Route::get('cetak/perorangan_delete/{id}', [CetakController::class, 'perorangan_delete'])->name('cetak.perorangan_delete');
    Route::get('cetak/perorangan_cetak/{id}', [CetakController::class, 'perorangan_cetak'])->name('cetak.perorangan_cetak');

    Route::get('cetak/badan', [CetakController::class, 'badan'])->name('cetak.badan');
    Route::get('cetak/badan_read/{id}', [CetakController::class, 'badan_read'])->name('cetak.badan_read');
    Route::get('cetak/badan_add', [CetakController::class, 'badan_add'])->name('cetak.badan_add');
    Route::post('cetak/badan_add_action', [CetakController::class, 'badan_add_action'])->name('cetak.badan_add_action');
    Route::get('cetak/badan_update/{id}', [CetakController::class, 'badan_update'])->name('cetak.badan_update');
    Route::post('cetak/badan_update_action/{id}', [CetakController::class, 'badan_update_action'])->name('cetak.badan_update_action');
    Route::get('cetak/badan_delete/{id}', [CetakController::class, 'badan_delete'])->name('cetak.badan_delete');
    Route::get('cetak/badan_cetak/{id}', [CetakController::class, 'badan_cetak'])->name('cetak.badan_cetak');

    // Titik Parkir Routes
    Route::get('titik', [TitikController::class, 'index'])->name('titik.index');
    Route::get('titik/read/{id}', [TitikController::class, 'read'])->name('titik.read');
    Route::get('titik/add', [TitikController::class, 'add'])->name('titik.add');
    Route::post('titik/add_action', [TitikController::class, 'add_action'])->name('titik.add_action');
    Route::get('titik/update/{id}', [TitikController::class, 'update'])->name('titik.update');
    Route::post('titik/update_action/{id}', [TitikController::class, 'update_action'])->name('titik.update_action');
    Route::get('titik/delete/{id}', [TitikController::class, 'delete'])->name('titik.delete');
    Route::get('titik/desa_json/{id}', [TitikController::class, 'desa_json'])->name('titik.desa_json');

    // Titik Juru Parkir Routes
    Route::get('titikjukir', [TitikjukirController::class, 'index'])->name('titikjukir.index');
    Route::get('titikjukir/read/{id}', [TitikjukirController::class, 'read'])->name('titikjukir.read');
    Route::get('titikjukir/add', [TitikjukirController::class, 'add'])->name('titikjukir.add');
    Route::post('titikjukir/add_action', [TitikjukirController::class, 'add_action'])->name('titikjukir.add_action');
    Route::get('titikjukir/update/{id}', [TitikjukirController::class, 'update'])->name('titikjukir.update');
    Route::post('titikjukir/update_action/{id}', [TitikjukirController::class, 'update_action'])->name('titikjukir.update_action');
    Route::get('titikjukir/delete/{id}', [TitikjukirController::class, 'delete'])->name('titikjukir.delete');
    Route::get('titikjukir/kta/{id}', [TitikjukirController::class, 'kta'])->name('titikjukir.kta');
    Route::get('titikjukir/spt/{id}', [TitikjukirController::class, 'spt'])->name('titikjukir.spt');
    Route::post('titikjukir/spt_action', [TitikjukirController::class, 'spt_action'])->name('titikjukir.spt_action');
    Route::get('titikjukir/sptcetak/{id}', [TitikjukirController::class, 'sptcetak'])->name('titikjukir.sptcetak');
    Route::get('titikjukir/titik_json/{id}', [TitikjukirController::class, 'titik_json'])->name('titikjukir.titik_json');

    // Ruas Jalan Routes
    Route::get('jalan', [JalanController::class, 'index'])->name('jalan.index');
    Route::get('jalan/read/{id}', [JalanController::class, 'read'])->name('jalan.read');
    Route::get('jalan/add', [JalanController::class, 'add'])->name('jalan.add');
    Route::post('jalan/add_action', [JalanController::class, 'add_action'])->name('jalan.add_action');
    Route::get('jalan/update/{id}', [JalanController::class, 'update'])->name('jalan.update');
    Route::post('jalan/update_action/{id}', [JalanController::class, 'update_action'])->name('jalan.update_action');
    Route::get('jalan/delete/{id}', [JalanController::class, 'delete'])->name('jalan.delete');
    Route::get('jalan/peta/{id}', [JalanController::class, 'peta'])->name('jalan.peta');

    // Pengelola Routes
    Route::get('pengelola/perorangan', [PengelolaController::class, 'perorangan'])->name('pengelola.perorangan');
    Route::get('pengelola/detail_perorangan/{id}', [PengelolaController::class, 'detail_perorangan'])->name('pengelola.detail_perorangan');
    Route::get('pengelola/verifikasi_perorangan/{id}', [PengelolaController::class, 'verifikasi_perorangan'])->name('pengelola.verifikasi_perorangan');
    Route::get('pengelola/unverifikasi_perorangan/{id}', [PengelolaController::class, 'unverifikasi_perorangan'])->name('pengelola.unverifikasi_perorangan');

    Route::get('pengelola/badan', [PengelolaController::class, 'badan'])->name('pengelola.badan');
    Route::get('pengelola/detail_badan/{id}', [PengelolaController::class, 'detail_badan'])->name('pengelola.detail_badan');
    Route::get('pengelola/verifikasi_badan/{id}', [PengelolaController::class, 'verifikasi_badan'])->name('pengelola.verifikasi_badan');
    Route::get('pengelola/unverifikasi_badan/{id}', [PengelolaController::class, 'unverifikasi_badan'])->name('pengelola.unverifikasi_badan');

    Route::get('pengelola/jukir', [PengelolaController::class, 'jukir'])->name('pengelola.jukir');
    Route::get('pengelola/detail_jukir/{id}', [PengelolaController::class, 'detail_jukir'])->name('pengelola.detail_jukir');
    Route::get('pengelola/verifikasi_jukir/{id}', [PengelolaController::class, 'verifikasi_jukir'])->name('pengelola.verifikasi_jukir');
    Route::get('pengelola/unverifikasi_jukir/{id}', [PengelolaController::class, 'unverifikasi_jukir'])->name('pengelola.unverifikasi_jukir');
    Route::get('pengelola/update_jukir/{id}', [PengelolaController::class, 'update_jukir'])->name('pengelola.update_jukir');
    Route::post('pengelola/update_jukir_action/{id}', [PengelolaController::class, 'update_jukir_action'])->name('pengelola.update_jukir_action');
});
