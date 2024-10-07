<?php

use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JadwalController;

use App\Http\Controllers\MateriController;
use App\Http\Controllers\TambahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JadwalguruController;
use App\Http\Controllers\NamaMateriController;
use App\Http\Controllers\TambahGuruController;
use App\Http\Controllers\MateriAdminController;
use App\Http\Controllers\NIlaidiGuruController;
use App\Http\Controllers\TambahTugasController; 
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TambahOrangtuaController;






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
    Route::get('/admin-tugas',[AdminController::class, 'tugas'] )->name('admin.tugas');

    //jadwal
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
        Route::get('jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
        Route::post('jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
        Route::get('jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
        Route::put('jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
        Route::delete('jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
    });

    //profil
        Route::get('/admin/profiles/show', [AdminController::class, 'Profile'])->name('admin.profile.index');
        Route::get('/admin/profiles/{id}/edit', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
        Route::put('/admin/profiles/{id}', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    
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
    Route::delete('/admin-delete/{id}',[TambahController::class, 'delete'])->name('delete');

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

 

    //CRUD NILAI
    Route::prefix('admin')->group(function () {
        Route::get('/admin/scores', [ScoreController::class, 'index'])->name('admin.scores.index');
        Route::get('/admin/scores/create', [ScoreController::class, 'create'])->name('admin.scores.create');
        Route::post('/admin/scores', [ScoreController::class, 'store'])->name('admin.scores.store');
        Route::get('/admin/scores/{id}/edit', [ScoreController::class, 'edit'])->name('admin.scores.edit');
        Route::put('/admin/scores/{id}', [ScoreController::class, 'update'])->name('admin.scores.update');
        Route::delete('admin//scores/{id}', [ScoreController::class, 'destroy'])->name('admin.scores.destroy');
        Route::get('admin//scores/cari', [ScoreController::class, 'cari'])->name('admin.scores.cari');
    });

    //CRUD TUGAS
        Route::get('/admin-tugas', [AdminController::class, 'tugas'])->name('admin.tugas.index');
        Route::get('/admin-tambahtugas', [AdminController::class, 'tambah_tugas'])->name('admin.create');
        Route::post('/admin-tambahtugas', [AdminController::class, 'create'])->name('create_tugas');
        Route::delete('/tugas/{id}', [AdminController::class, 'hapus'])->name('tugas.hapus');
        Route::get('/admin/tugas/edit/{id}', [AdminController::class, 'editTugas_Admin'])->name('tugas.edit');
        Route::put('/update/{id}', [AdminController::class, 'updateTugass'])->name('updatee_tugas');
        Route::get('/admin/cari', [AdminController::class, 'cari'])->name('siswa.cari');

        
    //CRUD MATERI
        Route::get('/admin/materi', [MateriAdminController::class, 'materiAdmin'])->name('admin.materi.index');
        Route::get('/admin/materi/create', [MateriAdminController::class, 'createMateri'])->name('adminMateri.create');
        Route::post('/admin/materi/store', [MateriAdminController::class, 'storeAdmin'])->name('adminMateri.store');
        Route::get('/admin/materi/{id}/edit', [MateriAdminController::class, 'edittMateri'])->name('adminMateri.edit');
        Route::put('/admin/materi/{id}', [MateriAdminController::class, 'updateMateri'])->name('adminMateri.update');
        Route::delete('/admin/materi/{id}', [MateriAdminController::class, 'destroyMateri'])->name('adminMateri.destroy');
        Route::get('/admin/materi/cari', [MateriAdminController::class, 'cariMateri'])->name('materiAdmin.cari');

    //Bagian Forum Diskusi
        Route::post('/forum', [PostController::class, 'store'])->name('post.store');
        Route::post('/forum/{post}/comment', [PostController::class, 'comment'])->name('post.comment');
        Route::get('/forum/index', [PostController::class, 'index'])->name('post.index');
        Route::post('/forum', [PostController::class, 'store'])->name('posts.store');
        Route::post('/forum/{post}/comment', [PostController::class, 'comment'])->name('posts.comment');

    //bagian menambah nama materi
        Route::get('namamapel', [NamaMateriController::class, 'index'])->name('namamapel.index');
        Route::get('namamapel/create', [NamaMateriController::class, 'create'])->name('namamapel.create');
        Route::post('namamapel', [NamaMateriController::class, 'store'])->name('namamapel.store');
        Route::get('namamapel/{materi}', [NamaMateriController::class, 'show'])->name('namamapel.show');
        Route::get('namamapel/{materi}/edit', [NamaMateriController::class, 'edit'])->name('namamapel.edit');        
        Route::put('namamapel/{materi}', [NamaMateriController::class, 'update'])->name('namamapel.update');
        Route::delete('namamapel/{materi}', [NamaMateriController::class, 'destroy'])->name('namamapel.destroy');

});

/////////// untuk siswa
Route::middleware(['auth','role:Siswa'])->group(function(){
    Route::get('/siswa-dashboard', [JadwalController::class, 'tampil'])->name('siswa.dashboard');
    Route::get('/siswa-profile', [SiswaController::class, 'profil'])->name('siswa.profiles.profil');
    Route::get('/siswa-materi', [SiswaController::class, 'materi'])->name('siswa.materi');
    Route::get('/siswa/jadwal', [SiswaController::class, 'jadwal'])->name('siswa.jadwal');
    Route::get('/siswa-nilai', [SiswaController::class, 'nilai'])->name('siswa.nilai');
    Route::get('/siswa-forum', [PostController::class, 'tampil'])->name('siswa.forumdiskusi');
    Route::get('/siswa/tugas', [SiswaController::class, 'tugas'])->name('siswa.tugas')->middleware('auth');

   
    //profile siswaaaa
    Route::get('/siswa/profiles/show', [ProfileController::class, 'show'])->name('siswa.profiles.show');
    Route::get('/siswa/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('siswa.profiles.edit');
    Route::put('/siswa/profiles/{id}', [ProfileController::class, 'update'])->name('siswa.profiles.update');
    //siswa melihat materi
    Route::get('/siswa-materi-lihat', [MateriController::class, 'lihatMateri_siswa'])->name('siswa.lihatmateri');
    Route::get('/siswa-pkn', [MateriController::class, 'pkn'])->name('siswa.pkn');
    Route::get('/siswa-bindo', [MateriController::class, 'bindo'])->name('siswa.bindo');
    Route::get('/siswa-sunda', [MateriController::class, 'sunda'])->name('siswa.sunda');

});

///////////// untuk guru
Route::middleware(['auth','role:Guru'])->group(function(){
    Route::get('/guru-dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
    Route::get('/guru-profile', [GuruController::class, 'profil'])->name('guru.profil');
    Route::get('/guru-tugas', [GuruController::class, 'tugas'])->name('guru.tugas.tugas');
    Route::get('/guru-materi', [GuruController::class, 'materi'])->name('guru.materi.materi');
    Route::get('/guru-jadwal', [GuruController::class, 'jadwal'])->name('guru.jadwal');
    Route::get('/guru-forum', [PostController::class, 'tampilGuru'])->name('guru.forumdiskusi');
    Route::get('/guru-nilai', [ScoreController::class, 'lihat'])->name('guru.scores.index');

    //profile guruuuuu
    Route::get('/guru/profiles', [GuruController::class, 'profil'])->name('guru.profile.show');
    Route::get('/guru/profiles/{id}/edit', [GuruController::class, 'editProfil'])->name('guru.profile.edit');
    Route::put('/guru/profiles/{id}', [GuruController::class, 'updateProfil'])->name('guru.profile.update');

    ///////TUGAS GURU
    Route::get('/guru/tambah-tugas', [TambahTugasController::class, 'tambah_tugas'])->name('guru.addTugas');
    Route::post('/guru/tambah-tugas', [TambahTugasController::class, 'create'])->name('guru.storetugas');
    Route::get('/guru/tugas/edit/{id}', [TambahTugasController::class, 'edit'])->name('edit_tugas');
    Route::put('/update/{id}', [TambahTugasController::class, 'update'])->name('update_tugas');
    Route::delete('/guru/tugas/{id}', [TambahTugasController::class, 'destroy'])->name('guru.tugas.destroy');
    Route::get('/guru/tugas/cari}', [TambahTugasController::class, 'cari'])->name('siswa.cari');



    ///////MATERI GURU
    Route::get('/guru/materi/create', [GuruController::class, 'create'])->name('materi.create');
    Route::post('/guru/materi/create', [GuruController::class, 'store'])->name('materi.store');
    Route::get('/guru/materi/{id}/edit', [GuruController::class, 'edit'])->name('materi.edit');
    Route::put('/guru/materi/{id}', [GuruController::class, 'update'])->name('materi.update');
    Route::delete('/guru/materi/{id}', [GuruController::class, 'destroy'])->name('materi.destroy');  
    Route::get('/guru/materi/cari', [GuruController::class, 'cari'])->name('materi.cari');



    //CRUD NILAI
    Route::prefix('guru')->group(function () {
        Route::get('/guru/scores', [NIlaidiGuruController::class, 'index'])->name('guru.scores.index');
        Route::get('/guru/scores/create', [NIlaidiGuruController::class, 'create'])->name('guru.scores.create');
        Route::post('/guru/scores', [NIlaidiGuruController::class, 'store'])->name('guru.scores.store');
        Route::get('/guru/scores/{id}/edit', [NIlaidiGuruController::class, 'edit'])->name('guru.scores.edit');
        Route::put('/guru/scores/{id}', [NIlaidiGuruController::class, 'update'])->name('guru.scores.update');
        Route::delete('/guru/scores/{id}', [NIlaidiGuruController::class, 'destroy'])->name('guru.scores.destroy');
        Route::get('/guru/scores/cari', [NIlaidiGuruController::class, 'cari'])->name('scores.cari');
        });

});
Route::middleware(['auth','role:Orang Tua'])->group(function(){
    Route::get('/orangtua-dashboard', [OrangTuaController::class, 'index'])->name('orangtua.dashboard');
    Route::get('/ortu-nilai', [ScoreController::class, 'ortu'])->name('ortu.nilai');
});
