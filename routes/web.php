<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\TPenelitianDosenController;
use App\Http\Controllers\TPenelitianDosenKoordinatorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
/*use App
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::pattern('id', '[0-9]+');
Route::get('/', function () {
    return view('landing');
})->name('home');

// Auth Routes
Route::get('/login', [AuthController::class, 'viewLogin'])->name('login.view');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirect root ke dashboard jika sudah login
// Route::get('/home', function () {
//     return redirect()->route('dashboard');
// });

// Route::get('/', function () {
//     if (auth()->check()) {
//         return redirect()->route('dashboard');
//     }
//     return view('landing');
// })->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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

    // Route::resource('penelitian-dosen', TPenelitianDosenController::class);
    // Route::post('penelitian-dosen/list/data', [TPenelitianDosenController::class, 'list'])->name('penelitian-dosen.list');
    // //statusPenelitian
    // Route::put('penelitian-dosen/{id}/status', [TPenelitianDosenController::class, 'statusPenelitian'])->name('penelitian-dosen.status');
    // Route::get('penelitian-dosen/{id}/delete', [TPenelitianDosenController::class, 'confirm']);

    // Route::resource('penelitian-dosen-koordinator', TPenelitianDosenKoordinatorController::class);
    // Route::post('penelitian-dosen-koordinator/list/data', [TPenelitianDosenKoordinatorController::class, 'list'])->name('penelitian-dosen-koordinator.list');
    // Route::get('penelitian-dosen-koordinator/{id}/delete', [TPenelitianDosenKoordinatorController::class, 'confirm']);

});