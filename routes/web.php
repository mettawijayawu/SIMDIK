<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Teacher\TeacherController; 
use App\Http\Controllers\Admin\AdminController; 
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\FormulirController;
use App\Http\Controllers\Admin\KelolaController;
use Illuminate\Support\Facades\Route;
use Naopon\LaravelGoogleDrive\Controller\GoogleDriveController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Halaman Utama (Welcome)
Route::get('/', [TeacherController::class, 'welcome'])->name('welcome'); 

// ------------------------------------------------------------------------
// 1. RUTE USER BIASA (PESERTA DIDIK/PARENT)
// ------------------------------------------------------------------------
Route::middleware('auth')->group(function () {
    
    // Rute Dashboard User 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 

    // RUTE JSON STATISTIK USER
    Route::get('/dashboard/stats', [DashboardController::class, 'getStatsJson'])->name('dashboard.stats.json');

    // Rute Menu User
    Route::get('/status-ppdb', [UserController::class, 'statusPPDB'])->name('user.status-ppdb');
    
    // Rute DAFTAR/FORMULIR PESERTA DIDIK
    Route::get('/formulir', [FormulirController::class, 'create'])->name('formulir.create');
    Route::post('/formulir', [FormulirController::class, 'store'])->name('formulir.store'); 
    Route::get('/formulir/{formulir}/edit', [FormulirController::class, 'edit'])->name('formulir.edit');
    Route::patch('/formulir/{formulir}', [FormulirController::class, 'update'])->name('formulir.update');

    // Rute halaman terima kasih
    Route::get('/terimakasih', function () {
        return view('terimakasih'); 
    })->name('terimakasih');

    // Rute Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ------------------------------------------------------------------------
// 2. RUTE TEACHER (MEMBUTUHKAN MIDDLEWARE 'teacher.check')
// ------------------------------------------------------------------------
Route::middleware(['auth', 'teacher.check'])->prefix('teacher')->name('teacher.')->group(function () {
    
    // Rute Dashboard Teacher
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard'); // Nama rute: teacher.dashboard

    // RUTE JSON STATISTIK TEACHER (DIBUKA & DINAMAI DENGAR BENAR)
    // Nama rute akan menjadi: teacher.dashboard.stats.json
    Route::get('/dashboard/stats/json', [TeacherController::class, 'getStatsJson'])->name('dashboard.stats.json')->middleware('auth:sanctum');;

    // Rute Data Peserta Didik (CRUD & Cetak)
    Route::get('/datapesertadidik', [TeacherController::class, 'dataPesertaDidik'])->name('data-peserta-didik');
    Route::get('/datapesertadidik/cetak-pdf', [TeacherController::class, 'cetakPdfPesertaDidik'])
        ->name('data-peserta-didik.cetak-pdf');
        
    Route::get('/datapesertadidik/{pesertaDidik}/edit', [TeacherController::class, 'editPesertaDidik'])->name('data-peserta-didik.edit');
    Route::patch('/datapesertadidik/{pesertaDidik}', [TeacherController::class, 'updatePesertaDidik'])->name('data-peserta-didik.update');
    Route::delete('/datapesertadidik/{pesertaDidik}', [TeacherController::class, 'destroyPesertaDidik'])->name('data-peserta-didik.destroy');

    // Rute Data PPDB (Formulir)
    Route::get('/datappdb', [TeacherController::class, 'dataPPDB'])->name('data-ppdb');
    
    Route::get('/datappdb/{formulir:no_form}/edit', [TeacherController::class, 'editForm'])->name('data-ppdb.edit');
    Route::patch('/datappdb/{formulir:no_form}', [TeacherController::class, 'updateForm'])->name('data-ppdb.update');

    Route::get('/informasi', [TeacherController::class, 'informasi'])->name('informasi');

    // Rute Data PPDB (CRUD & Cetak)
    Route::get('/datappdb', [TeacherController::class, 'dataPPDB'])->name('data-ppdb');
    Route::get('/datappdb/cetak-pdf', [TeacherController::class, 'cetakPdfPPDB'])
        ->name('data-ppdb.cetak-pdf');
    
    // CRUD Gelombang
    Route::post('/gelombang', [TeacherController::class, 'storeGelombang'])->name('gelombang.store');
    Route::put('/gelombang/{gelombang}', [TeacherController::class, 'updateGelombang'])->name('gelombang.update');
    Route::delete('/gelombang/{gelombang}', [TeacherController::class, 'destroyGelombang'])->name('gelombang.destroy');

    // Pengaturan Foto Homepage
    Route::post('/update-foto-homepage', [TeacherController::class, 'updateFotoHomepage'])->name('update.foto.homepage');

    Route::get('/peserta-didik/cetak-pdf', [TeacherController::class, 'cetakPdfPesertaDidik'])
    ->name('data-peserta-didik.cetak');

    Route::get('/contact', [TeacherController::class, 'contact'])->name('contact');
});

// ------------------------------------------------------------------------
// 3. RUTE ADMIN (MEMBUTUHKAN MIDDLEWARE 'admin.check')
// ------------------------------------------------------------------------
Route::middleware(['auth', 'admin.check'])->prefix('admin')->group(function () {
    
    // Rute Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Rute CRUD Data User
    Route::get('/datauser', [AdminController::class, 'dataUser'])->name('admin.data-user');
    Route::get('/datauser/{user}/edit', [AdminController::class, 'editUser'])->name('admin.data-user.edit');
    Route::patch('/datauser/{user}', [AdminController::class, 'updateUser'])->name('admin.data-user.update');
    Route::delete('/datauser/{user}', [AdminController::class, 'destroyUser'])->name('admin.data-user.destroy');

// Route Index (READ - Menampilkan kedua data)
// URL: /kelola
Route::get('/kelola', [KelolaController::class, 'index'])->name('admin.kelola');

// Route untuk TAHUN MASUK
Route::post('/kelola/tahun', [KelolaController::class, 'storeTahun'])->name('admin.kelola.tahun.store');
Route::delete('/kelola/tahun/{id}', [KelolaController::class, 'destroyTahun'])->name('admin.kelola.tahun.destroy');

// Route untuk TINGKAT
Route::post('/kelola/tingkat', [KelolaController::class, 'storeTingkat'])->name('admin.kelola.tingkat.store');
Route::delete('/kelola/tingkat/{id}', [KelolaController::class, 'destroyTingkat'])->name('admin.kelola.tingkat.destroy');
});

// ------------------------------------------------------------------------
// 4. RUTE AUTENTIKASI KHUSUS (ADMIN/GURU)
// ------------------------------------------------------------------------
// Rute ini TANPA middleware 'guest'. Pengecekan sesi dilakukan di AdminController@create
Route::prefix('admin')->group(function () {
    
    // Tampilkan form Login Admin/Guru (URL: /admin)
    Route::get('/', [AdminController::class, 'create'])
        ->name('admin.login'); 

    // Proses login Admin/Guru (URL: /admin/login)
    Route::post('/login', [AdminController::class, 'store'])
        ->name('admin.login.attempt');
});

require __DIR__ . '/auth.php';