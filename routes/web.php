<?php

use App\Http\Controllers\Biaya\CostHarianController;
use App\Http\Controllers\Biaya\CostHarianDDController;
use App\Http\Controllers\Biaya\CostHotelController;
use App\Http\Controllers\Biaya\CostHotelDDController;
use App\Http\Controllers\Biaya\CostRepresentasiController;
use App\Http\Controllers\Biaya\CostRepresentasiDDController;
use App\Http\Controllers\Biaya\CostTaxiController;
use App\Http\Controllers\Biaya\CostUangHarianController;
use App\Models\Satker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterData\UserController;
use App\Http\Controllers\Konfigurasi\MenuController;
use App\Http\Controllers\Konfigurasi\RoleController;
use App\Http\Controllers\MasterData\TahunController;
use App\Http\Controllers\MasterData\SatkerController;
use App\Http\Controllers\Konfigurasi\AksesRoleController;
use App\Http\Controllers\Konfigurasi\AksesUserController;
use App\Http\Controllers\Konfigurasi\PermissionController;
use App\Http\Controllers\MasterData\BelanjaController;
use App\Http\Controllers\MasterData\BendaharaController;
use App\Http\Controllers\MasterData\EselonController;
use App\Http\Controllers\MasterData\PaguController;
use App\Http\Controllers\MasterData\PaKpaController;
use App\Http\Controllers\MasterData\PangkatController;
use App\Http\Controllers\MasterData\PegawaiController;
use App\Http\Controllers\MasterData\PejabatController;
use App\Http\Controllers\MasterData\PPKomController;
use App\Http\Controllers\MasterData\PptkController;
use App\Http\Controllers\MasterData\SubKegiatanController;
use App\Http\Controllers\MasterData\TransportController;
use App\Http\Controllers\Nodin\NodinController;
use App\Http\Controllers\SPT\SuratTugasController;
use App\Models\Biaya\CostHarianDD;
use App\Models\Biaya\CostHotelDD;
use App\Models\Biaya\CostRepresentasiDD;
use App\Models\Biaya\CostUangHarian;
use App\Models\PaKpa;

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

Route::get('/', function () {
    return view('welcome');
});

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
        Route::resource('satker', SatkerController::class);
        Route::get('satker-arsip', [SatkerController::class, 'archive'])->name('satker.archive');
        Route::post('satker/{id}/restore', [SatkerController::class, 'restore'])->name('satker.restore');
        Route::delete('satker/{id}/force-delete', [SatkerController::class, 'destroyPermanent'])->name('satker.forceDelete');
        Route::resource('subkegiatan', SubKegiatanController::class);
        Route::get('subkegiatan-arsip', [SubKegiatanController::class, 'archive'])->name('subkegiatan.archive');
        Route::post('subkegiatan/{id}/restore', [SubKegiatanController::class, 'restore'])->name('subkegiatan.restore');
        Route::delete('subkegiatan/{id}/force-delete', [SubKegiatanController::class, 'destroyPermanent'])->name('subkegiatan.forceDelete');
        Route::resource('rekening', BelanjaController::class);
        Route::get('rekening-arsip', [BelanjaController::class, 'archive'])->name('rekening.archive');
        Route::post('rekening/{id}/restore', [BelanjaController::class, 'restore'])->name('rekening.restore');
        Route::delete('rekening/{id}/force-delete', [BelanjaController::class, 'destroyPermanent'])->name('rekening.forceDelete');
        Route::get('rekening/{belanjaId}/pagu', [PaguController::class, 'paguModal'])->name('rekening.paguModal');
        Route::post('rekening/{belanjaId}/pagu', [PaguController::class, 'storePagu'])->name('rekening.paguStore');
        Route::resource('pangkat', PangkatController::class);
        Route::resource('pegawai', PegawaiController::class);
        Route::get('pegawai-arsip', [PegawaiController::class, 'archive'])->name('pegawai.archive');
        Route::post('pegawai/{id}/restore', [PegawaiController::class, 'restore'])->name('pegawai.restore');
        Route::delete('pegawai/{id}/force-delete', [PegawaiController::class, 'destroyPermanent'])->name('pegawai.forceDelete');
        Route::resource('pakpa', PaKpaController::class);
        Route::get('pakpa-arsip', [PaKpaController::class, 'archive'])->name('pakpa.archive');
        Route::post('pakpa/{id}/restore', [PaKpaController::class, 'restore'])->name('pakpa.restore');
        Route::delete('pakpa/{id}/force-delete', [PaKpaController::class, 'destroyPermanent'])->name('pakpa.forceDelete');
        Route::resource('ppk', PPKomController::class);
        Route::get('ppk-arsip', [PPKomController::class, 'archive'])->name('ppk.archive');
        Route::post('ppk/{id}/restore', [PPKomController::class, 'restore'])->name('ppk.restore');
        Route::delete('ppk/{id}/force-delete', [PPKomController::class, 'destroyPermanent'])->name('ppk.forceDelete');
        Route::resource('pptk', PptkController::class);
        Route::get('pptk-arsip', [PptkController::class, 'archive'])->name('pptk.archive');
        Route::post('pptk/{id}/restore', [PptkController::class, 'restore'])->name('pptk.restore');
        Route::delete('pptk/{id}/force-delete', [PptkController::class, 'destroyPermanent'])->name('pptk.forceDelete');
        Route::resource('bendahara', BendaharaController::class);
        Route::get('bendahara-arsip', [BendaharaController::class, 'archive'])->name('bendahara.archive');
        Route::post('bendahara/{id}/restore', [BendaharaController::class, 'restore'])->name('bendahara.restore');
        Route::delete('bendahara/{id}/force-delete', [BendaharaController::class, 'destroyPermanent'])->name('bendahara.forceDelete');
        Route::resource('transport', TransportController::class);
        Route::get('transport-arsip', [TransportController::class, 'archive'])->name('transport.archive');
        Route::post('transport/{id}/restore', [TransportController::class, 'restore'])->name('transport.restore');
        Route::delete('transport/{id}/force-delete', [TransportController::class, 'destroyPermanent'])->name('transport.forceDelete');
        Route::resource('pejabat', PejabatController::class);
        Route::get('pejabat-arsip', [PejabatController::class, 'archive'])->name('pejabat.archive');
        Route::post('pejabat/{id}/restore', [PejabatController::class, 'restore'])->name('pejabat.restore');
        Route::delete('pejabat/{id}/force-delete', [PejabatController::class, 'destroyPermanent'])->name('pejabat.forceDelete');
        Route::resource('eselon', EselonController::class);
        Route::get('eselon-arsip', [EselonController::class, 'archive'])->name('eselon.archive');
        Route::post('eselon/{id}/restore', [EselonController::class, 'restore'])->name('eselon`.restore');
        Route::delete('eselon/{id}/force-delete', [EselonController::class, 'destroyPermanent'])->name('eselon`.forceDelete');
    });
    Route::group(['prefix' => 'biaya', 'as' => 'biaya.'], function () {
        Route::resource('hotel', CostHotelController::class);
        Route::resource('harian', CostHarianController::class);
        Route::resource('representasi', CostRepresentasiController::class);
        Route::resource('taxi', CostTaxiController::class);
        Route::resource('ddharian', CostHarianDDController::class);
        Route::resource('ddhotel', CostHotelDDController::class);
        Route::resource('ddrepresentasi', CostRepresentasiDDController::class);
        Route::resource('uangharian', CostUangHarianController::class);
    });
    Route::group(['prefix' => 'nota', 'as' => 'nota.'], function () {
        Route::resource('nodin', NodinController::class);
        Route::get('nodin/{id}/pdf', [NodinController::class, 'generatePdf'])->name('nodin.generatePdf');
    });

    Route::group(['prefix' => 'surat', 'as' => 'surat.'], function () {
        Route::resource('spt', SuratTugasController::class);
        Route::get('spt/{id}/pdf', [SuratTugasController::class, 'generatePdf'])->name('spt.generatePdf');
    });
});

Route::get('admin', function () {
    return '<h1>Helo Admin</h1>';
})->middleware(['auth', 'verified', 'role:admin']);

require __DIR__ . '/auth.php';
