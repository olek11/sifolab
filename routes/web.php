<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


// Route::get('/', function () {
//     return view('welcome');
// });

// ini bagian landing page
Route::get('/', function () {
    return view('landing');
})->name('home');
// Route::get('/daftaralat', function () {
//     return view('daftaralat');

Route::get('/daftaralat', [LandingPageController::class, 'daftaralat'])->name('daftaralat');
Route::post('/daftaralat', [LandingPageController::class, 'store'])->name('daftaralat.store');

Route::get('/SOP', function () {
    return view('sop');
})->name('sop');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';

// ini bagian untuk user
Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboarduser'])->name('DashboardUser');
});

// ini bagian untuk admin
Route::middleware(['auth', 'adminMiddleware'])->group(function () {

    // bagian dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboardadmin'])->name('DashboardAdmin');


    // bagian untuk manajemen user
    Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');
    Route::get('/admin/user/create', [AdminController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/user', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/user/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/user/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/user/export/excel', [AdminController::class, 'exportExcel'])->name('admin.user.export.excel');

    // bagian daftar alat
    Route::get('/admin/alat', [AdminController::class, 'alat'])->name('admin.alat');
    Route::get('/admin/alat/create', [AdminController::class, 'createAlat'])->name('admin.alat.create');
    Route::post('/admin/alat', [AdminController::class, 'storeAlat'])->name('admin.alat.store');
    Route::get('/admin/alat/edit/{id}', [AdminController::class, 'editAlat'])->name('admin.alat.edit');
    Route::put('/admin/alat/{id}', [AdminController::class, 'updateAlat'])->name('admin.alat.update');
    Route::delete('/admin/alat/{id}', [AdminController::class, 'destroyAlat'])->name('admin.alat.destroy');
    Route::get('/admin/alat/export/excel', [AdminController::class, 'exportAlatExcel'])->name('admin.alat.export.excel');

    // bagian untuk daftar bahan
    Route::get('/admin/bahan', [AdminController::class, 'bahan'])->name('admin.bahan');
    Route::get('/admin/bahan/create', [AdminController::class, 'createBahan'])->name('admin.bahan.create');
    Route::post('/admin/bahan', [AdminController::class, 'storeBahan'])->name('admin.bahan.store');
    Route::get('/admin/bahan/edit/{id}', [AdminController::class, 'editBahan'])->name('admin.bahan.edit');
    Route::put('/admin/bahan/{id}', [AdminController::class, 'updateBahan'])->name('admin.bahan.update');
    Route::delete('/admin/bahan/{id}', [AdminController::class, 'destroyBahan'])->name('admin.bahan.destroy');
    Route::get('/admin/bahan/export/excel', [AdminController::class, 'exportBahanExcel'])->name('admin.bahan.export.excel');

    // bagian untuk peminjaman alat
    Route::get('/admin/peminjaman', [AdminController::class, 'peminjaman'])->name('admin.peminjaman');
    Route::get('/admin/peminjaman/create', [AdminController::class, 'createPeminjaman'])->name('admin.peminjaman.create');
    Route::post('/admin/peminjaman', [AdminController::class, 'storePeminjaman'])->name('admin.peminjaman.store');
    Route::get('/admin/peminjaman/edit/{id}', [AdminController::class, 'editPeminjaman'])->name('admin.peminjaman.edit');
    Route::put('/admin/peminjaman/{id}', [AdminController::class, 'updatePeminjaman'])->name('admin.peminjaman.update');
    Route::delete('/admin/peminjaman/{id}', [AdminController::class, 'destroyPeminjaman'])->name('admin.peminjaman.destroy');
    Route::post('/admin/peminjaman/{id}/approve', [AdminController::class, 'approvePeminjaman'])->name('admin.peminjaman.approve');
    Route::post('/admin/peminjaman/{id}/reject', [AdminController::class, 'rejectPeminjaman'])->name('admin.peminjaman.reject');
    Route::get('/admin/peminjaman/export/excel', [AdminController::class, 'exportPeminjamanExcel'])->name('admin.peminjaman.export.excel');

    // bagian untuk jadwal laboratorium
    Route::get('/admin/jadwal', [AdminController::class, 'jadwal'])->name('admin.jadwal');
    Route::get('/admin/jadwal/create', [AdminController::class, 'createJadwal'])->name('admin.jadwal.create');
    Route::post('/admin/jadwal', [AdminController::class, 'storeJadwal'])->name('admin.jadwal.store');
    Route::get('/admin/jadwal/edit/{id}', [AdminController::class, 'editJadwal'])->name('admin.jadwal.edit');
    Route::put('/admin/jadwal/{id}', [AdminController::class, 'updateJadwal'])->name('admin.jadwal.update');
    Route::delete('/admin/jadwal/{id}', [AdminController::class, 'destroyJadwal'])->name('admin.jadwal.destroy');
    Route::post('/admin/jadwal/{id}/approve', [AdminController::class, 'approve'])->name('admin.jadwal.approve');
    Route::post('/admin/jadwal/{id}/reject', [AdminController::class, 'reject'])->name('admin.jadwal.reject');
    Route::get('/admin/jadwal/export/excel', [AdminController::class, 'exportJadwalExcel'])->name('admin.jadwal.export.excel');
});
