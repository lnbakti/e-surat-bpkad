<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Routes untuk Surat Masuk
    Route::resource('surat-masuk', SuratMasukController::class);
    
    // Routes untuk Surat Keluar
    Route::resource('surat-keluar', SuratKeluarController::class);
    
    // Routes untuk Pencarian
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    
    // Routes untuk Laporan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        
        // Surat Masuk
        Route::get('/surat-masuk', [LaporanController::class, 'suratMasuk'])->name('surat-masuk');
        Route::post('/surat-masuk/preview', [LaporanController::class, 'previewSuratMasuk'])->name('surat-masuk.preview');
        Route::post('/surat-masuk/download', [LaporanController::class, 'downloadSuratMasuk'])->name('surat-masuk.download');
        
        // Surat Keluar
        Route::get('/surat-keluar', [LaporanController::class, 'suratKeluar'])->name('surat-keluar');
        Route::post('/surat-keluar/preview', [LaporanController::class, 'previewSuratKeluar'])->name('surat-keluar.preview');
        Route::post('/surat-keluar/download', [LaporanController::class, 'downloadSuratKeluar'])->name('surat-keluar.download');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';