<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TambahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JadwalguruController;
use App\Http\Controllers\TambahGuruController;
use App\Http\Controllers\TambahTugasController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TambahOrangtuaController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


    Route::get('/admin-tugas', [AdminController::class, 'tugas'])->name('admin.tugas');
    Route::get('/admin-tambahtugas', [AdminController::class, 'tambah_tugas'])->name('admin.create');
    Route::post('/admin-tambahtugas', [AdminController::class, 'create'])->name('create_tugas');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit_tugas');
    Route::put('/update/{id}', [AdminController::class, 'update'])->name('update_tugas');
    Route::delete('/tugas/{id}', [AdminController::class, 'hapus'])->name('tugas.destroy');
    Route::get('/admin/cari', [AdminController::class, 'cari'])->name('siswa.cari');







Auth::routes(); // Ini akan menambahkan semua rute autentikasi bawaan Laravel termasuk login dan register

// Route untuk pengalihan setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth','role:Admin'])->group(function(){
    //Bagian Admin
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin-materi',[MateriController::class, 'tampil'] )->name('admin.materi');
    // Route::get('/admin-jadwal',[AdminController::class, 'jadwal'] )->name('admin.jadwal');
    Route::get('/admin-materi',[AdminController::class, 'materi'] )->name('admin.materi');
    Route::get('/admin-profil',[AdminController::class, 'profil'] )->name('admin.profil');
    Route::get('/admin-tugas',[AdminController::class, 'tugas'] )->name('admin.tugas');
    Route::get('/admin-addMateri',[AdminController::class, 'add'] )->name('admin.addMateri');

    //jadwal
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
        Route::get('jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
        Route::post('jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
        Route::get('jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
        Route::put('jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
        Route::delete('jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
    });

    //jadwal guru
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('jadwalguru', [JadwalguruController::class, 'index'])->name('jadwalguru.index');
        Route::get('jadwalguru/create', [JadwalguruController::class, 'create'])->name('jadwalguru.create');
        Route::post('jadwalguru', [JadwalguruController::class, 'store'])->name('jadwalguru.store');
        Route::get('jadwalguru/{id}/edit', [JadwalguruController::class, 'edit'])->name('jadwalguru.edit');
        Route::put('jadwalguru/{id}', [JadwalguruController::class, 'update'])->name('jadwalguru.update');
        Route::delete('jadwalguru/{id}', [JadwalguruController::class, 'destroy'])->name('jadwalguru.destroy');
    });
    

    //tambah akun
    Route::get('/admin-tambahsiswa',[TambahController::class, 'index'])->name('tambah');
    Route::get('/admin-create',[TambahController::class, 'create'])->name('create');
    Route::post('/admin-store',[TambahController::class, 'store'])->name('store');
    Route::get('/admin-edit/{id}',[TambahController::class, 'edit'])->name('edit');
    Route::put('/admin-update/{id}',[TambahController::class, 'update'])->name('update');
    Route::delete('/admin-delete/{id}',[TambahController::class, 'delet'])->name('delete');

    //tambah guru
    Route::get('/admin-tambahguru',[TambahGuruController::class, 'index'])->name('tambahguru');
    Route::get('/admin-createguru',[TambahGuruController::class, 'create'])->name('createguru');
    Route::post('/admin-store-guru',[TambahGuruController::class, 'store'])->name('store.guru');
    Route::get('/admin-editguru/{id}',[TambahGuruController::class, 'edit'])->name('edit.guru');
    Route::put('/admin-update-guru/{id}',[TambahGuruController::class, 'update'])->name('update.guru');
    Route::delete('/admin-deleteguru/{id}',[TambahGuruController::class, 'delet'])->name('delet.guru');

    //tambah ortu
    Route::get('/admin-ortu',[TambahOrangtuaController::class, 'index'])->name('ortu');
    Route::get('/admin-createortu',[TambahOrangtuaController::class, 'create'])->name('create.ortu');
    Route::post('/admin-store-ortu',[TambahOrangtuaController::class, 'store'])->name('store.ortu');
    Route::get('/admin-editortu/{id}',[TambahOrangtuaController::class, 'edit'])->name('edit.ortu');
    Route::put('/admin-update-ortu/{id}',[TambahOrangtuaController::class, 'update'])->name('update.ortu');
    Route::delete('/admin-deleteortu/{id}',[TambahOrangtuaController::class, 'delet'])->name('delet.ortu');

    //profil
    Route::get('profiles/show', [ProfileController::class, 'show'])->name('profiles.show');
    Route::get('profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');

    //CRUD NILAI
    Route::prefix('admin')->group(function () {
        Route::get('/scores', [ScoreController::class, 'index'])->name('scores.index');
        Route::get('/scores/create', [ScoreController::class, 'create'])->name('scores.create');
        Route::post('/scores', [ScoreController::class, 'store'])->name('scores.store');
        Route::get('/scores/{id}/edit', [ScoreController::class, 'edit'])->name('scores.edit');
        Route::put('/scores/{id}', [ScoreController::class, 'update'])->name('scores.update');
        Route::delete('/scores/{id}', [ScoreController::class, 'destroy'])->name('scores.destroy');
        Route::get('/scores/cari', [ScoreController::class, 'cari'])->name('scores.cari');
    });


    // Route::get('/guru', [GuruController::class, 'index2'])->name('guru.index');
    // Route::get('/guru', [GuruController::class, 'index'])->middleware('auth:guru')->name('guru.index');
});

Route::middleware(['auth','role:Guru'])->group(function(){
    Route::get('/guru-dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
     //Materi di guru
     Route::get('/guru-materi', [MateriController::class, 'materi'])->name('guru.materi.materi');
     Route::get('/materi/create', [MateriController::class, 'create'])->name('materi.create');
     Route::post('/materi/store', [MateriController::class, 'store'])->name('materi.store');
     Route::get('/materi/{id}/edit', [MateriController::class, 'edit'])->name('materi.edit');
     Route::put('/materi/{id}', [MateriController::class, 'update'])->name('materi.update');
     Route::delete('/materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');
     Route::get('/materi/cari', [MateriController::class, 'cari'])->name('materi.cari');

    //Menu Di Halaman Guru
    Route::get('/guru/jadwal', [GuruController::class, 'jadwal'])->name('guru.jadwal');

    Route::get('/guru-profil', [GuruController::class, 'profil'])->name('guru.profil');
    Route::get('/guru-addMateri', [GuruController::class, 'addMateri'])->name('guru.addMateri');
    Route::get('/guru-addTugas', [GuruController::class, 'addTugas'])->name('guru.addTugas');

    //Crud Tugas di Guru
    Route::get('/guru-tugas', [TambahTugasController::class, 'tugas'])->name('guru.tugas.tugas');
    Route::get('/guru-tambahtugas', [TambahTugasController::class, 'tambah_tugas'])->name('guru.addTugas');
    Route::post('/guru-tambahtugas', [TambahTugasController::class, 'create'])->name('create_tugas');
    Route::get('/edit/{id}', [TambahTugasController::class, 'edit'])->name('edit_tugas');
    Route::put('/update/{id}', [TambahTugasController::class, 'update'])->name('update_tugas');
    Route::delete('/tugas/{id}', [TambahTugasController::class, 'destroy'])->name('tugas.destroy');
    Route::get('/guru/cari', [TambahTugasController::class, 'cari'])->name('siswa.cari');

    // Route untuk guru menambah tugas
    Route::post('/guru/tambah-tugas', [GuruController::class, 'addTugas'])->name('guru.tambah.tugas');
    Route::post('/guru/tambah-tugas', [GuruController::class, 'storeTugas'])->name('guru.addTugas');

    Route::get('/gurunilai', [ScoreController::class, 'tampilGuru'])->name('guru.index');
});


//tambah siswa-admin
Route::get('/admin-tambahsiswa',[TambahController::class, 'index'])->name('tambah');
Route::get('/admin-create',[TambahController::class, 'create'])->name('create');
Route::post('/admin-store',[TambahController::class, 'store'])->name('store');
Route::get('/admin-edit/{id}',[TambahController::class, 'edit'])->name('edit');
Route::put('/admin-update/{id}',[TambahController::class, 'update'])->name('update');
Route::delete('/admin-delete/{id}',[TambahController::class, 'delet'])->name('delete');

//tambah guru-admin
Route::get('/admin-tambahguru',[TambahGuruController::class, 'index'])->name('tambahguru');
Route::get('/admin-createguru',[TambahGuruController::class, 'create'])->name('createguru');
Route::post('/admin-store-guru',[TambahGuruController::class, 'store'])->name('store.guru');
Route::get('/admin-editguru/{id}',[TambahGuruController::class, 'edit'])->name('edit.guru');
Route::put('/admin-update-guru/{id}',[TambahGuruController::class, 'update'])->name('update.guru');
Route::delete('/admin-deleteguru/{id}',[TambahGuruController::class, 'delet'])->name('delet.guru');

//tambah ortu-admin
Route::get('/admin-ortu',[TambahOrangtuaController::class, 'index'])->name('ortu');
Route::get('/admin-createortu',[TambahOrangtuaController::class, 'create'])->name('create.ortu');
Route::post('/admin-store-ortu',[TambahOrangtuaController::class, 'store'])->name('store.ortu');
Route::get('/admin-editortu/{id}',[TambahOrangtuaController::class, 'edit'])->name('edit.ortu');
Route::put('/admin-update-ortu/{id}',[TambahOrangtuaController::class, 'update'])->name('update.ortu');
Route::delete('/admin-deleteortu/{id}',[TambahOrangtuaController::class, 'delet'])->name('delet.ortu');


//sidebar siswa
Route::get('/siswa-dashboard', [JadwalController::class, 'tampil'])->name('siswa.dashboard');
Route::get('/siswa-materi', [SiswaController::class, 'materi'])->name('siswa.materi');
Route::get('/siswa-jadwal', [JadwalController::class, 'tampil'])->name('siswa.jadwal');
Route::get('/siswa-tugas', [SiswaController::class, 'tugas'])->name('siswa.tugas');
Route::get('/siswa-profil', [SiswaController::class, 'profil'])->name('siswa.profil');
Route::get('/guru-addTugas', [SiswaController::class, 'addTugas'])->name('guru.addTugas');
Route::get('/siswa-tugas', [SiswaController::class, 'tugas'])->name('siswa.tugas');
Route::get('/lihat/materi', [MateriController::class, 'muncul'])->name('lihat.materi');
Route::get('/siswa-nilai', [ScoreController::class, 'wujud'])->name('siswa.wujud');

    //profil
    Route::get('profiles/show', [ProfileController::class, 'show'])->name('profiles.show');
    Route::get('profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');

// Route::get('/siswa/tugas', [SiswaController::class, 'tugas'])->name('siswa.tugas');

// Route untuk siswa melihat tugas

Route::post('/guru/tambah-tugas', [GuruController::class, 'storeTugas'])->name('guru.addTugas');


//Menu Di Halaman Guru
Route::get('/guru-dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
Route::get('/guru-jadwal', [GuruController::class, 'jadwal'])->name('guru.jadwal');
Route::get('/guru-profil', [GuruController::class, 'profil'])->name('guru.profil');
Route::get('/guru-addMateri', [GuruController::class, 'addMateri'])->name('guru.addMateri');
Route::get('/guru-addTugas', [GuruController::class, 'addTugas'])->name('guru.addTugas');
Route::get('/guru-nilai', [ScoreController::class, 'lihat'])->name('tampil-Guru');
// Route untuk guru menambah tugas
Route::get('/guru/tambah-tugas', [GuruController::class, 'addTugas'])->name('guru.tambah.tugas');
Route::post('/guru/tambah-tugas', [GuruController::class, 'storeTugas'])->name('guru.addTugas');
//
Route::get('/guru', [GuruController::class, 'index2'])->name('guru.index');
Route::get('/guru', [GuruController::class, 'index'])->middleware('auth:guru')->name('guru.index');

//Crud Tugas di Guru
Route::get('/guru-tugas', [TambahTugasController::class, 'tugas'])->name('guru.tugas.tugas');
// Route::get('/admin-tugas', [TambahTugasController::class, 'lihatAdmin'])->name('admin.tugas');
Route::get('/guru-tambahtugas', [TambahTugasController::class, 'tambah_tugas'])->name('guru.addTugas');
Route::post('/guru-tambahtugas', [TambahTugasController::class, 'create'])->name('create_tugas');
Route::get('/edit/{id}', [TambahTugasController::class, 'edit'])->name('edit_tugas');
Route::put('/update/{id}', [TambahTugasController::class, 'update'])->name('update_tugas');
Route::delete('/tugas/{id}', [TambahTugasController::class, 'destroy'])->name('tugas.destroy');
Route::get('/guru/cari', [TambahTugasController::class, 'cari'])->name('siswa.cari');



//CRUD NILAI
    Route::get('/scores', [ScoreController::class, 'index'])->name('scores.index');
    Route::get('/scores/create', [ScoreController::class, 'create'])->name('scores.create');
    Route::post('/scores', [ScoreController::class, 'store'])->name('scores.store');
    Route::get('/scores/{id}/edit', [ScoreController::class, 'edit'])->name('scores.edit');
    Route::put('/scores/{id}', [ScoreController::class, 'update'])->name('scores.update');
    Route::delete('/scores/{id}', [ScoreController::class, 'destroy'])->name('scores.destroy');
    Route::get('/scores/cari', [ScoreController::class, 'cari'])->name('scores.cari');

//CRUD MATERI
    Route::get('/materi', [MateriController::class, 'materi'])->name('guru.materi.materi');
    Route::get('/materi/create', [MateriController::class, 'create'])->name('materi.create');
    Route::post('/materi/store', [MateriController::class, 'store'])->name('materi.store');
    Route::get('/materi/{id}/edit', [MateriController::class, 'edit'])->name('materi.edit');
    Route::put('/materi/{id}', [MateriController::class, 'update'])->name('materi.update');
    Route::delete('/materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');
    Route::get('/materi/cari', [MateriController::class, 'cari'])->name('materi.cari');
    
    // Route::get('/scores/cari', [ScoreController::class, 'cari'])->name('scores.cari');

    
    
    
    //Orang Tua
    Route::get('/orangtua-dashboard', [OrangTuaController::class, 'index'])->name('orangtua.dashboard');  
    Route::get('/logout', [OrangTuaController::class, 'index'])->name('orangtua.dashboard'); 




Route::get('/lihat/materi', [MateriController::class, 'tampil'])->name('admin.materi');






Route::get('/admin-tugas', [TambahTugasController::class, 'wujud'])->name('admin.wujud');




Route::middleware(['auth','role:Siswa'])->group(function(){
    //siswa
    Route::get('/siswa-dashboard', [JadwalController::class, 'tampil'])->name('siswa.dashboard');
    Route::get('/siswa-materi', [SiswaController::class, 'materi'])->name('siswa.materi');
    Route::get('/siswa-jadwal', [JadwalController::class, 'tampil'])->name('siswa.jadwal');
    Route::get('/siswa-tugas', [SiswaController::class, 'tugas'])->name('siswa.tugas');
    Route::get('/siswa-profil', [SiswaController::class, 'profil'])->name('siswa.profil');
    Route::get('/guru-addTugas', [SiswaController::class, 'addTugas'])->name('guru.addTugas');
    Route::get('/siswa-tugas', [SiswaController::class, 'tugas'])->name('siswa.tugas');
    Route::get('/lihat/tugas', [MateriController::class, 'muncul'])->name('lihat.materi');
    Route::get('/siswa-nilai', [ScoreController::class, 'wujud'])->name('siswa.wujud');
    Route::get('/siswa-lihatmateri', [MateriController::class, 'lihat'])->name('siswa.lihatmateri');

    // Route untuk siswa melihat tugas
    Route::get('/siswa/tugas', [SiswaController::class, 'tugas'])->name('siswa.tugas');
});

Route::middleware(['auth','role:Orang Tua'])->group(function(){

    Route::get('/orangtua-dashboard', [OrangTuaController::class, 'index'])->name('orangtua.dashboard');  
    // Route::get('/logout', [OrangTuaController::class, 'index'])->name('orangtua.dashboard'); 
});
