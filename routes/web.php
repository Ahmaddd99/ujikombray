<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\DatatableController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\MasyarakatController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\PengaduanController as PengaduanAdmin;
use App\Http\Controllers\WelcomeController;

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

// Route::get('/', function () {
//     return view('welcome',[WelcomeController::class,'index']);
// });

Route::get('/', [WelcomeController::class, 'index']);
Route::get('register', [AuthUserController::class, 'register'])->name('register');
Route::post('register', [AuthUserController::class, 'storeRegister'])->name('store.register');
Route::get('login', [AuthUserController::class, 'login'])->name('login');
Route::post('authenticate', [AuthUserController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [AuthUserController::class, 'logout'])->name('logout');

Route::prefix('masyarakat')->name('masyarakat')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('.dashboard');
    Route::get('profile', [DashboardController::class, 'profile'])->name('.profile');
    Route::get('get-pengaduan', [PengaduanController::class, 'getPengaduan'])->name('.get-pengaduan');
    Route::prefix('pengaduan')->name('.pengaduan')->group(function () {
        Route::get('/', [PengaduanController::class, 'index'])->name('.index');
        Route::get('/create', [PengaduanController::class, 'create'])->name('.create');
        Route::post('/store', [PengaduanController::class, 'store'])->name('.store');
        Route::get('/tanggapan/{no_pengaduan}', [PengaduanController::class, 'tanggapanDetail'])->name('.tanggapan.detail');
        Route::delete('/destroy/{no_pengaduan}', [PengaduanController::class, 'destroy'])->name('.destroy');
    });
});

Route::prefix('admin')->name('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('.login');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('.authenticate');
    Route::get('/logout', [LoginController::class, 'logout'])->name('.logout');

    Route::middleware(['auth:petugas'])->group(function () {
        Route::get('dashboard', [DashboardAdminController::class, 'index'])->name('.dashboard');

        Route::middleware(['admin'])->group(function () {
            Route::prefix('masyarakat')->name('.masyarakat')->group(function () {
                Route::get('/', [MasyarakatController::class, 'index'])->name('.index');
                Route::get('/get-masyarakat', [DatatableController::class, 'masyarakat'])->name('.get-masyarakat');
                Route::post('store', [MasyarakatController::class, 'store'])->name('.store');
                Route::delete('destroy/{id}', [MasyarakatController::class, 'destroy'])->name('.destroy');
            });
            Route::prefix('petugas')->name('.petugas')->group(function () {
                Route::get('/', [PetugasController::class, 'index'])->name('.index');
                Route::get('/get-petugas', [DatatableController::class, 'petugas'])->name('.get-petugas');
                Route::post('store', [PetugasController::class, 'store'])->name('.store');
                Route::delete('destroy/{id}', [PetugasController::class, 'destroy'])->name('.destroy');
            });
            Route::get('pengaduan-all',[FilterController::class, 'index'])->name('.pengaduan-all');
            Route::get('get-pengaduan-all',[DatatableController::class, 'pengaduanAll'])->name('.get-pengaduan-all');
            Route::get('print-all',[FilterController::class, 'printAll'])->name('.print-all');

            Route::get('pengaduan-pending',[DatatableController::class,'pengaduanPending'])->name('.pengaduan-pending');

        });

        Route::get('pengaduan-undone', function (){ return view('admin.pengaduan.undone'); })->name('.pengaduan-undone');
        Route::get('get-undone', [DatatableController::class, 'pengaduanProgres'])->name('.get-undone');
        Route::get('pengaduan/{no_pengaduan}', [PengaduanAdmin::class, 'index'])->name('.pengaduan-detail');
        Route::post('create-tanggapan/{no_pengaduan}', [PengaduanAdmin::class, 'createTanggapan'])->name('.create-tanggapan');

        Route::get('pengaduan-done', function (){ return view('admin.pengaduan.done'); })->name('.pengaduan-done');
        Route::get('get-done', [DatatableController::class, 'pengaduanDone'])->name('.get-done');
    });
});
