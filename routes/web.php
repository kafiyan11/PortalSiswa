<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TambahController;
use App\Http\Controllers\TambahTugasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

Route::middleware(['auth'])->group(function(){
//Bagian Admin
Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin-materi',[AdminController::class, 'materi'] )->name('admin.materi');
Route::get('/admin-jadwal',[AdminController::class, 'jadwal'] )->name('admin.jadwal');
Route::get('/admin-profil',[AdminController::class, 'profil'] )->name('admin.profil');
Route::get('/admin-tugas',[AdminController::class, 'tugas'] )->name('admin.tugas');
Route::get('/admin-addMateri',[AdminController::class, 'add'] )->name('admin.addMateri');

//tambah akun
Route::get('/admin-tambahsiswa',[TambahController::class, 'index'])->name('tambah');
Route::get('/admin-create',[TambahController::class, 'create'])->name('create');
Route::post('/admin-store',[TambahController::class, 'store'])->name('store');
Route::get('/admin-edit/{id}',[TambahController::class, 'edit'])->name('edit');
Route::put('/admin-update/{id}',[TambahController::class, 'update'])->name('update');
Route::delete('/admin-delete/{id}',[TambahController::class, 'delet'])->name('delete');


//siswa
Route::get('/siswa-dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
Route::get('/siswa-materi', [GuruController::class, 'materi'])->name('siswa.materi');
Route::get('/siswa-jadwal', [GuruController::class, 'jadwal'])->name('siswa.jadwal');
Route::get('/siswa-tugas', [GuruController::class, 'tugas'])->name('siswa.tugas');
Route::get('/siswa-profil', [GuruController::class, 'profil'])->name('siswa.profil');
Route::get('/guru-addTugas', [GuruController::class, 'addTugas'])->name('guru.addTugas');
Route::get('/siswa-tugas', [SiswaController::class, 'tugas'])->name('siswa.tugas');


//Menu Di Halaman Guru
Route::get('/guru-dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
Route::get('/guru-materi', [GuruController::class, 'materi'])->name('guru.materi');
Route::get('/guru-jadwal', [GuruController::class, 'jadwal'])->name('guru.jadwal');
Route::get('/guru-profil', [GuruController::class, 'profil'])->name('guru.profil');
Route::get('/guru-addMateri', [GuruController::class, 'addMateri'])->name('guru.addMateri');
Route::get('/guru-addTugas', [GuruController::class, 'addTugas'])->name('guru.addTugas');

//Crud Tugas di Guru
Route::get('/guru-tugas', [TambahTugasController::class, 'tugas'])->name('guru.tugas');
Route::get('/guru-tambahtugas', [TambahTugasController::class, 'tambah_tugas'])->name('guru.addTugas');
Route::post('/guru-tambahtugas', [TambahTugasController::class, 'create'])->name('create_tugas');
Route::get('/edit/{id}', [TambahTugasController::class, 'edit'])->name('edit_tugas');
Route::put('/update/{id}', [TambahTugasController::class, 'update'])->name('update_tugas');
Route::delete('/tugas/{id}', [TambahTugasController::class, 'destroy'])->name('tugas.destroy');
// Route::get('/guru/tugas', [GuruController::class, 'tugas'])->name('guru.tugas');





//Orang Tua
Route::get('/orangtua-dashboard', [OrangTuaController::class, 'index'])->name('orangtua.dashboard');  


Route::get('/logout', [OrangTuaController::class, 'index'])->name('orangtua.dashboard'); 
});

                                                       