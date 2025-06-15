<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PPEPController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Pattern ID
Route::pattern('id', '[0-9]+');

// Route Landing
Route::get('/', function () {
    return view('landing');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

// Auth
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

// Sidebar partial
Route::get('/sidebar/kriteria', function () {
    $kriteria = \App\Models\KriteriaModel::all();
    return view('partials.ppep_sidebar', compact('kriteria'));
});

// Middleware group: auth
Route::middleware(['auth'])->group(function () {

    Route::get('/sidebar', [SidebarController::class, 'refreshSidebar']);

    // User routes
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/list', [UserController::class, 'list']);
        Route::get('/create', [UserController::class, 'create']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/create_ajax', [UserController::class, 'create_ajax']);
        Route::post('/ajax', [UserController::class, 'store_ajax']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);
        Route::get('/{id}/edit', [UserController::class, 'edit']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    // Level routes
    Route::prefix('level')->group(function () {
        Route::get('/', [LevelController::class, 'index']);
        Route::post('/list', [LevelController::class, 'list']);
        Route::get('/create', [LevelController::class, 'create']);
        Route::post('/', [LevelController::class, 'store']);
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
        Route::post('/ajax', [LevelController::class, 'store_ajax']);
        Route::get('/{id}', [LevelController::class, 'show']);
        Route::get('/{id}/edit', [LevelController::class, 'edit']);
        Route::put('/{id}', [LevelController::class, 'update']);
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
        Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
        Route::delete('/{id}', [LevelController::class, 'destroy']);
    });

    // Kriteria routes
    Route::prefix('kriteria')->group(function () {
        Route::get('/', [KriteriaController::class, 'index']);
        Route::post('/list', [KriteriaController::class, 'list']);
        Route::get('/create', [KriteriaController::class, 'create']);
        Route::post('/', [KriteriaController::class, 'store']);
        Route::get('/create_ajax', [KriteriaController::class, 'create_ajax']);
        Route::post('/ajax', [KriteriaController::class, 'store_ajax']);
        Route::get('/{id}', [KriteriaController::class, 'show']);
        Route::get('/{id}/edit', [KriteriaController::class, 'edit']);
        Route::put('/{id}', [KriteriaController::class, 'update']);
        Route::get('/{id}/edit_ajax', [KriteriaController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [KriteriaController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [KriteriaController::class, 'confirm_ajax']);
        Route::get('/{id}/show_ajax', [KriteriaController::class, 'show_ajax']);
        Route::delete('/{id}/delete_ajax', [KriteriaController::class, 'delete_ajax']);
        Route::delete('/{id}', [KriteriaController::class, 'destroy']);
    });

    // Dokumen
    Route::prefix('dokumen')->group(function () {
        Route::get('/{kriteria}/{jenis_list}', [DokumenController::class, 'index'])->name('dokumen.index');
        Route::post('/{kriteria}/{jenis_list}/store', [DokumenController::class, 'store'])->name('dokumen.store');
        Route::get('/{kriteria}/{jenis_list}/list', [DokumenController::class, 'list']);
        Route::get('/{kriteria}/{jenis_list}/preview', [DokumenController::class, 'preview'])->name('dokumen.preview');
        Route::get('/{kriteria}/{jenis_list}/{id}/edit', [DokumenController::class, 'edit'])->name('dokumen.edit');
        Route::put('/{kriteria}/{jenis_list}/{dokumen}', [DokumenController::class, 'update'])->name('dokumen.update');
        Route::delete('/{kriteria}/{jenis_list}/{id}', [DokumenController::class, 'destroy'])->name('dokumen.destroy');
        Route::get('/{kriteria_nama}/pdf', [DokumenController::class, 'generatePDF'])->name('dokumen.generatePDF');
    });

    // PPEP
    Route::get('/ppep/{id}', [PPEPController::class, 'index'])->name('ppep.index');
});

// Static views
Route::view('/denah/lantai5', 'denah.lantai5');
Route::view('/denah/lantai6', 'denah.lantai6');
Route::view('/denah/lantai7', 'denah.lantai7');

// Dummy views for each kriteria
Route::get('/kriteria/1', fn () => view('kriteria.kriteria1'));
Route::get('/kriteria/2', fn () => view('kriteria.criteria2'));
Route::get('/kriteria/3', fn () => view('kriteria.criteria3'));
Route::get('/kriteria/4', fn () => view('kriteria.criteria4'));
Route::get('/kriteria/5', fn () => view('kriteria.criteria5'));
Route::get('/kriteria/6', fn () => view('kriteria.criteria6'));
Route::get('/kriteria/7', fn () => view('kriteria.criteria7'));
Route::get('/kriteria/8', fn () => view('kriteria.criteria8'));
Route::get('/kriteria/9', fn () => view('kriteria.criteria9'));
