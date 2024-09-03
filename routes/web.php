<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TambahController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(); // Ini akan menambahkan semua rute autentikasi bawaan Laravel termasuk login dan register

// Route untuk pengalihan setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Bagian Admin
Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin-materi',[AdminController::class, 'materi'] )->name('admin.materi');
Route::get('/admin-jadwal',[AdminController::class, 'jadwal'] )->name('admin.jadwal');
Route::get('/admin-profil',[AdminController::class, 'profil'] )->name('admin.profil');
Route::get('/admin-add',[AdminController::class, 'add'] )->name('admin.add');

//tambah akun
Route::get('/admin-tambahsiswa',[TambahController::class, 'index'])->name('tambah');
Route::get('/admin-create',[TambahController::class, 'create'])->name('create');
Route::post('/admin-store',[TambahController::class, 'store'])->name('store');
Route::get('/admin-edit/{id}',[TambahController::class, 'edit'])->name('edit');
Route::put('/admin-update/{id}',[TambahController::class, 'update'])->name('update');
Route::delete('/admin-delete/{id}',[TambahController::class, 'delet'])->name('delete');




Route::get('/siswa-dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
Route::get('/guru-dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
Route::get('/orangtua-dashboard', [OrangTuaController::class, 'index'])->name('orangtua.dashboard');  

Route::get('/logout', [OrangTuaController::class, 'index'])->name('orangtua.dashboard');                                                        