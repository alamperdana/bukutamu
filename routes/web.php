<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterData\UserController;
use App\Http\Controllers\Konfigurasi\MenuController;
use App\Http\Controllers\Konfigurasi\RoleController;
use App\Http\Controllers\MasterData\TahunController;
use App\Http\Controllers\Referensi\StatusController;
use App\Http\Controllers\Referensi\LayananController;
use App\Http\Controllers\Konfigurasi\AksesRoleController;
use App\Http\Controllers\Konfigurasi\AksesUserController;
use App\Http\Controllers\Konfigurasi\PermissionController;
use App\Http\Controllers\Referensi\LokasiLayananController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::match(['GET', 'HEAD'], '/', function () {
//     return 'INI ROUTE / BERHASIL!';
// })->name('home');

Route::get('/', function () {
    return view('welcome'); // Ini akan menampilkan tampilan 'welcome'
});

Route::resource('absensi', AbsensiController::class);

// Route::get('/', [AbsensiController::class, 'create'])->name('absensi.create');
// Route::post('/', [AbsensiController::class, 'store'])->name('absensi.store');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'konfigurasi', 'as' => 'konfigurasi.'], function () {
        Route::put('menu/sort', [MenuController::class, 'sort'])->name('menu.sort');
        Route::resource('menu', MenuController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::get('akses-role/{role}/role', [AksesRoleController::class, 'getPermissionsByRole']);
        Route::resource('akses-role', AksesRoleController::class)->except(['create', 'store', 'delete'])->parameters(['akses-role' => 'role']);
        Route::get('akses-user/{user}/user', [AksesUserController::class, 'getPermissionsByUser']);
        Route::resource('akses-user', AksesUserController::class)->except(['create', 'store', 'delete'])->parameters(['akses-user' => 'user']);
    });

    Route::group(['prefix' => 'master-data', 'as' => 'master-data.'], function () {
        Route::resource('users', UserController::class);
        Route::resource('tahun', TahunController::class);
        Route::get('tahun-arsip', [TahunController::class, 'archive'])->name('tahun.archive');
        Route::post('tahun/{id}/restore', [TahunController::class, 'restore'])->name('tahun.restore');
        Route::delete('tahun/{id}/force-delete', [TahunController::class, 'destroyPermanent'])->name('tahun.forceDelete');
    });

    Route::group(['prefix' => 'referensi', 'as' => 'referensi.'], function () {
        Route::resource('layanan', LayananController::class);
        Route::resource('lokasi', LokasiLayananController::class);
        Route::resource('status', StatusController::class);
    });
});

Route::get('admin', function () {
    return '<h1>Helo Admin</h1>';
})->middleware(['auth', 'verified', 'role:admin']);

require __DIR__ . '/auth.php';
