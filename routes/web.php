<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('landing');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});



Route::get('/dashboard', [DashboardController::class, 'index']);

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

Route::view('/denah/lantai5', 'denah.lantai5');
Route::view('/denah/lantai6', 'denah.lantai6');
Route::view('/denah/lantai7', 'denah.lantai7');

// Route untuk setiap criteria
Route::get('/kriteria/1', function () {
    return view('kriteria.kriteria1');
});

Route::get('/kriteria/2', function () {
    return view('kriteria.criteria2');
});

Route::get('/kriteria/3', function () {
    return view('kriteria.criteria3');
});

Route::get('/kriteria/4', function () {
    return view('kriteria.criteria4');
});

Route::get('/kriteria/5', function () {
    return view('kriteria.criteria5');
});

Route::get('/kriteria/6', function () {
    return view('kriteria.criteria6');
});

Route::get('/kriteria/7', function () {
    return view('kriteria.criteria7');
});

Route::get('/kriteria/8', function () {
    return view('kriteria.criteria8');
});

Route::get('/kriteria/9', function () {
    return view('kriteria.criteria9');
});
