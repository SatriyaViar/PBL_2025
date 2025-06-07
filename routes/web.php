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

Route::pattern('id', '[0-9]+');
Route::get('/', [DashboardController::class, 'index']);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

// routes/web.php
Route::get('/sidebar/kriteria', function () {
    $kriteria = \App\Models\KriteriaModel::all();
    return view('partials.ppep_sidebar', compact('kriteria'));
});




Route::middleware(['auth'])->group(function () {

    Route::get('/sidebar', [SidebarController::class, 'refreshSidebar']);

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/list', [UserController::class, 'list']);
        Route::get('/create', [UserController::class, 'create']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [UserController::class, 'store_ajax']);    // Menyimpan data user baru Ajax
        Route::get('/{id}', [UserController::class, 'show']);
        Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);
        Route::get('/{id}/edit', [UserController::class, 'edit']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); //Menampilkan Halaman form Edit User AJAX
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); //Menyimpan perubahan data User AJAX
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    Route::group(['prefix' => 'level'], function () {
        Route::get('/', [LevelController::class, 'index']);
        Route::post('/list', [LevelController::class, 'list']);
        Route::get('/create', [LevelController::class, 'create']);
        Route::post('/', [LevelController::class, 'store']);
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [LevelController::class, 'store_ajax']);    // Menyimpan data user baru Ajax
        Route::get('/{id}', [LevelController::class, 'show']);
        Route::get('/{id}/edit', [LevelController::class, 'edit']);
        Route::put('/{id}', [LevelController::class, 'update']);
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); //Menampilkan Halaman form Edit User AJAX
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); //Menyimpan perubahan data User AJAX
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
        Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
        Route::delete('/{id}', [LevelController::class, 'destroy']);
    });

    Route::group(['prefix' => 'kriteria'], function () {
        Route::get('/', [KriteriaController::class, 'index']);
        Route::post('/list', [KriteriaController::class, 'list']);
        Route::get('/create', [KriteriaController::class, 'create']);
        Route::post('/', [KriteriaController::class, 'store']);
        Route::get('/create_ajax', [KriteriaController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [KriteriaController::class, 'store_ajax']);    // Menyimpan data user baru Ajax
        Route::get('/{id}', [KriteriaController::class, 'show']);
        Route::get('/{id}/edit', [KriteriaController::class, 'edit']);
        Route::put('/{id}', [KriteriaController::class, 'update']);
        Route::get('/{id}/edit_ajax', [KriteriaController::class, 'edit_ajax']); //Menampilkan Halaman form Edit User AJAX
        Route::put('/{id}/update_ajax', [KriteriaController::class, 'update_ajax']); //Menyimpan perubahan data User AJAX
        Route::get('/{id}/delete_ajax', [KriteriaController::class, 'confirm_ajax']);
        Route::get('/{id}/show_ajax', [KriteriaController::class, 'show_ajax']);
        Route::delete('/{id}/delete_ajax', [KriteriaController::class, 'delete_ajax']);
        Route::delete('/{id}', [KriteriaController::class, 'destroy']);
    });
    Route::prefix('dokumen/{kriteria}/{jenis}')->group(function () {
        Route::get('/', [DokumenController::class, 'index']);
        Route::get('/create', [DokumenController::class, 'create']);
        Route::post('/', [DokumenController::class, 'store']);
        Route::get('/{id}/edit', [DokumenController::class, 'edit']);
        Route::put('/{id}', [DokumenController::class, 'update']);
        Route::delete('/{id}', [DokumenController::class, 'destroy']);
    });
    Route::get('/ppep/{id}', [PPEPController::class, 'index'])->name('ppep.index');

    Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

});
