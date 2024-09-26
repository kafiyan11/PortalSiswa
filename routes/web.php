<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TambahController;
use App\Http\Controllers\TambahGuruController;
use App\Http\Controllers\TambahOrangtuaController;
use App\Http\Controllers\TambahTugasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'storeSocialLinks'])->name('welcome');











Auth::routes(); // Ini akan menambahkan semua rute autentikasi bawaan Laravel termasuk login dan register

// Route untuk pengalihan setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth','role:Admin'])->group(function(){
    //Bagian Admin
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin-profil',[AdminController::class, 'profil'] )->name('admin.profil');


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
    Route::resource('scores', ScoreController::class);

//CRUD MATERI
    Route::get('/materi', [MateriController::class, 'materi'])->name('guru.materi.materi');
    Route::get('/materi/create', [MateriController::class, 'create'])->name('materi.create');
    Route::post('/materi/store', [MateriController::class, 'store'])->name('materi.store');
    Route::get('/materi/{id}/edit', [MateriController::class, 'edit'])->name('materi.edit');
    Route::put('/materi/{id}', [MateriController::class, 'update'])->name('materi.update');
    Route::delete('/materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');
    Route::get('/materi/cari', [MateriController::class, 'cari'])->name('materi.cari');
    
    // Route::get('/scores/cari', [ScoreController::class, 'cari'])->name('scores.cari');

    
    //

    Route::get('/forum', [PostController::class, 'index'])->name('forum.index');
    Route::post('/forum', [PostController::class, 'store'])->name('posts.store');
    Route::post('/forum/{post}/comment', [PostController::class, 'comment'])->name('posts.comment');
    
    // Rute khusus tampilan siswa dan guru
    Route::get('/forum/siswa', [PostController::class, 'tampil'])->name('forum.siswa');
    Route::get('/forum/guru', [PostController::class, 'tampilGuru'])->name('forum.guru');
    

    
    //Orang Tua
    Route::get('/orangtua-dashboard', [OrangTuaController::class, 'index'])->name('orangtua.dashboard');  
    Route::get('/logout', [OrangTuaController::class, 'index'])->name('orangtua.dashboard'); 
    //jadwal
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
        Route::get('jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
        Route::post('jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
        Route::get('jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
        Route::put('jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
        Route::delete('jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
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

    //CRUD MATERI
    Route::get('/admin/materi', [AdminController::class, 'materiAdmin'])->name('admin.materi.index');
        Route::get('/admin/materi/create', [AdminController::class, 'createMateri'])->name('adminMateri.create');
        Route::post('/admin/materi/store', [AdminController::class, 'storeAdmin'])->name('adminMateri.store');
        Route::get('/admin/materi/{id}/edit', [AdminController::class, 'edittMateri'])->name('adminMateri.edit');
        Route::put('/admin/materi/{id}', [AdminController::class, 'updateMateri'])->name('adminMateri.update');
        Route::delete('/admin/materi/{id}', [AdminController::class, 'destroyMateri'])->name('adminMateri.destroy');
        Route::get('/admin/materi/cari', [AdminController::class, 'cariMateri'])->name('materiAdmin.cari');

    //CRUD NILAI
    Route::prefix('admin')->group(function () {
        Route::get('/scores', [ScoreController::class, 'index'])->name('scores.index');
        Route::get('/scores/create', [ScoreController::class, 'create'])->name('scores.create');
        Route::post('/scores', [ScoreController::class, 'store'])->name('scores.store');
        Route::get('/scores/{id}/edit', [ScoreController::class, 'edit'])->name('scores.edit');
        Route::put('/scores/{id}', [ScoreController::class, 'update'])->name('scores.update');
        Route::delete('/scores/{id}', [ScoreController::class, 'destroy'])->name('scores.destroy');
        Route::get('/scores/cari', [ScoreController::class, 'cari'])->name('scores.cari');

    //CRUD TUGAS
    Route::get('/admin-tugas', [AdminController::class, 'tugas'])->name('admin.tugas.index');
        Route::get('/admin-tambahtugas', [AdminController::class, 'tambah_tugas'])->name('admin.create');
        Route::post('/admin-tambahtugas', [AdminController::class, 'create'])->name('create_tugas');
        Route::get('/edit/{id}', [AdminController::class, 'editTugas'])->name('editt_tugas');
        Route::put('/update/{id}', [AdminController::class, 'updateTugas'])->name('updatee_tugas');
        Route::delete('/tugas/{id}', [AdminController::class, 'hapus'])->name('tugas.hapus');
        Route::get('/admin/cari', [AdminController::class, 'cari'])->name('siswa.cari');
    });

});

Route::middleware(['auth','role:Guru'])->group(function(){
    Route::get('/guru-dashboard', [GuruController::class, 'index'])->name('guru.dashboard');

    //Menu Di Halaman Guru
    Route::get('/guru-jadwal', [JadwalController::class, 'tingali'])->name('guru.jadwal');
       Route::get('/guru-profil', [GuruController::class, 'profil'])->name('guru.profil');
       Route::get('/guru-addMateri', [GuruController::class, 'addMateri'])->name('guru.addMateri');
       Route::get('/guru-addTugas', [GuruController::class, 'addTugas'])->name('guru.addTugas');
       
    //profil
    Route::get('profiles/show', [ProfileController::class, 'show'])->name('profiles.show');
        Route::get('profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
        Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');

     //Materi di guru
    Route::get('/guru/materi/materi', [MateriController::class, 'materi'])->name('guru.materi.materi');
        Route::get('/guru/materi/create', [MateriController::class, 'create'])->name('materi.create');
        Route::post('/guru/materi/store', [MateriController::class, 'store'])->name('materi.store');
        Route::get('/guru/materi/{id}/edit', [MateriController::class, 'edit'])->name('materi.edit');
        Route::put('/guru/materi/{id}', [MateriController::class, 'update'])->name('materi.update');
        Route::delete('/guru/materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');
        Route::get('/materi/cari', [MateriController::class, 'cari'])->name('materi.cari');

    //Niai Guru
    Route::get('/guru/nilai', [GuruController::class, 'nilai'])->name('guru.scores.index');
        Route::get('/guru/nilai/create', [GuruController::class, 'tambah_nilai'])->name('guru.scores.create');
        Route::post('/guru/nilai/store', [GuruController::class, 'storeNilai'])->name('guru.scores.store');
        Route::get('/guru/nilai/{id}/edit', [GuruController::class, 'editNilai'])->name('guru.scores.edit');
        Route::put('/guru/nilai/{id}', [GuruController::class, 'updateNilai'])->name('guru.scores.update');
        Route::delete('/guru/nilai/{id}', [GuruController::class, 'destroyNilai'])->name('guru.scores.destroy');
        Route::get('/guru/nilai/cari', [GuruController::class, 'cari'])->name('guru.scores.cari');

    //Crud Tugas di Guru
    Route::get('/guru-tugas', [TambahTugasController::class, 'tugas'])->name('guru.tugas.tugas');
        Route::get('/guru-tambahtugas', [TambahTugasController::class, 'tambah_tugas'])->name('guru.addTugas');
        Route::post('/guru-tambahtugas', [TambahTugasController::class, 'create'])->name('create_tugas');
        Route::get('/edit/{id}', [TambahTugasController::class, 'edit'])->name('edit_tugas');
        Route::put('/update/{id}', [TambahTugasController::class, 'update'])->name('update_tugas');
        Route::delete('/tugas/{id}', [TambahTugasController::class, 'destroy'])->name('tugas.destroy');
        Route::get('/guru/cari', [TambahTugasController::class, 'cari'])->name('siswa.cari');
});




Route::middleware(['auth','role:Siswa'])->group(function(){
    //Menu di Halaman Siswa
    Route::get('/siswa-dashboard', [JadwalController::class, 'tampil'])->name('siswa.dashboard');
    Route::get('/siswa-materi', [SiswaController::class, 'materi'])->name('siswa.materi');
    Route::get('/siswa-jadwal', [JadwalController::class, 'tampil'])->name('siswa.jadwal');
    Route::get('/siswa-tugas', [SiswaController::class, 'tugas'])->name('siswa.tugas');
    Route::get('/siswa-profil', [SiswaController::class, 'profil'])->name('siswa.profil');
    Route::get('/guru-addTugas', [SiswaController::class, 'addTugas'])->name('guru.addTugas');
    Route::get('/siswa-tugas', [SiswaController::class, 'tugas'])->name('siswa.tugas');
    Route::get('/siswa-nilai', [ScoreController::class, 'wujud'])->name('siswa.wujud');
    Route::get('/siswa-lihatmateri', [MateriController::class, 'lihatMateri_siswa'])->name('siswa.lihatmateri');
});



Route::middleware(['auth','role:Orang Tua'])->group(function(){
    Route::get('/orangtua-dashboard', [OrangTuaController::class, 'index'])->name('orangtua.dashboard');  
    // Route::get('/logout', [OrangTuaController::class, 'index'])->name('orangtua.dashboard'); 
});
