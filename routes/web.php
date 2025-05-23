<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LevelController;
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

Route::get('/', [DashboardController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/list', [UserController::class, 'list']);
    Route::get('/create', [UserController::class, 'create']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/create', [UserController::class, 'create']); // Menampilkan halaman form tambah user Ajax
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
    Route::get('/create', [LevelController::class, 'create']); // Menampilkan halaman form tambah user Ajax
    Route::post('/store', [LevelController::class, 'store']);    // Menyimpan data user baru Ajax
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); //Menampilkan Halaman form Edit User AJAX
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); //Menyimpan perubahan data User AJAX
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
    Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
    Route::delete('/{id}', [LevelController::class, 'destroy']);
});
