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
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TambahController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PostGuruController;
use App\Http\Controllers\PostSiswaController;
use App\Http\Controllers\JadwalguruController;
use App\Http\Controllers\NamaMateriController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\TambahGuruController;
use App\Http\Controllers\CommentGuruController;
use App\Http\Controllers\MateriAdminController;
use App\Http\Controllers\NIlaidiGuruController;
use App\Http\Controllers\ProfileGuruController;
use App\Http\Controllers\TambahTugasController;
use App\Http\Controllers\CommentSiswaController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfilOrangtuaController;
use App\Http\Controllers\TambahOrangtuaController;






Route::get('/', [SocialLinkController::class, 'landing_page'])->name('welcome');


// routes/web.php


Auth::routes(); // Ini akan menambahkan semua rute autentikasi bawaan Laravel termasuk login dan register

// Rute untuk menampilkan halaman home

// Rute untuk menyimpan dan menampilkan social links

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

    
    Route::get('/social-links', [SocialLinkController::class, 'index'])->name('social-links.index');
    Route::get('/social-links/edit', [SocialLinkController::class, 'edit'])->name('social-links.edit');
    Route::post('/social-links/update', [SocialLinkController::class, 'update'])->name('social-links.update');
    

    //profil
Route::get('/admin/profiles', [ProfileAdminController::class, 'show'])->name('admin.profiles.show');
Route::get('/admin/profiles/edit/{id}', [ProfileAdminController::class, 'edit'])->name('admin.profiles.edit');
Route::put('/admin/profiles/update/{id}', [ProfileAdminController::class, 'update'])->name('admin.profiles.update');


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
        Route::delete('admin/tugas/{id}', [AdminController::class, 'hapus'])->name('tugas.hapus');
        Route::get('/admin/tugas/edit/{id}', [AdminController::class, 'editTugas_Admin'])->name('tugas.edit');
        Route::put('admin/update/{id}', [AdminController::class, 'updateTugass'])->name('updatee_tugas');



        Route::get('/admin/cari', [AdminController::class, 'cari'])->name('siswa.cari');

        
    //CRUD MATERI
        Route::get('/admin/materi', [MateriAdminController::class, 'materiAdmin'])->name('admin.materi.index');
        Route::get('/admin/materi/create', [MateriAdminController::class, 'createMateri'])->name('adminMateri.create');
        Route::post('/admin/materi/store', [MateriAdminController::class, 'storeAdmin'])->name('adminMateri.store');
        Route::get('/admin/materi/{id}/edit', [MateriAdminController::class, 'editMateri'])->name('adminMateri.edit');
        Route::put('/admin/materi/{id}', [MateriAdminController::class, 'updateMateri'])->name('adminMateri.update');        
        Route::delete('/admin/materi/{id}', [MateriAdminController::class, 'destroyMateri'])->name('adminMateri.destroy');
        Route::get('/admin/materi/cari', [MateriAdminController::class, 'cariMateri'])->name('materiAdmin.cari');


        //forum
        Route::get('forum', [PostController::class, 'index'])->name('posts.index');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

        
        Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('posts.comment.store');
        Route::post('/posts/{post}/comment/{comment}/reply', [CommentController::class, 'replyComment'])->name('posts.comment.reply');
        Route::delete('/comment/delete/{id}', [CommentController::class, 'destroy'])->name('comment.delete');
        



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
    Route::get('/siswa-jadwal', [SiswaController::class, 'jadwal'])->name('siswa.jadwal');
    Route::get('/siswa-tugas', [SiswaController::class, 'tugas'])->name('siswa.tugas');
    Route::get('/siswa-nilai', [ScoreController::class, 'wujud'])->name('siswa.wujud');
    Route::get('/siswa-forum', [PostController::class, 'tampil'])->name('siswa.forumdiskusi');
    
    //coba
    Route::get('/siswa-coba', [SiswaController::class, 'materii'])->name('siswa.coba');

    //profile
    Route::get('siswa/profiles', [ProfileController::class, 'show'])->name('siswa.profiles.show');
    Route::get('siswa/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('siswa.profiles.edit');
    Route::put('sisws/profiles/{id}', [ProfileController::class, 'update'])->name('siswa.profiles.update');
    

    //siswa melihat materi
    Route::get('/siswa/materi/lihat/{id_mapel}', [MateriController::class, 'lihatMateriSiswa'])->name('siswa.lihatmateri');

     //forum
    Route::get('/siswa/forumdiskusi', [PostSiswaController::class, 'index'])->name('siswa.forumdiskusi');
    Route::post('/siswa/forumdiskusi', [PostSiswaController::class, 'store'])->name('siswa.posts.store');
    Route::delete('/siswa/forumdiskusi/{post}', [PostSiswaController::class, 'destroy'])->name('siswa.posts.destroy');

        
    Route::post('/siswa/forumdiskusi/{post}/comment', [CommentSiswaController::class, 'store'])->name('siswa.comment.store');
    Route::post('/siswa/forumdiskusi/{post}/comment/{comment}/reply', [CommentSiswaController::class, 'replyComment'])->name('siswa.comment.reply');
    Route::delete('/siswa/forumdiskusi/comment/{comment}', [CommentSiswaController::class, 'destroy'])->name('siswa.comment.destroy');
});

///////////// untuk guru
Route::middleware(['auth','role:Guru'])->group(function(){
    Route::get('/guru-dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
    Route::get('/guru-profile', [GuruController::class, 'profil'])->name('guru.profil');
    Route::get('/guru-tugas', [TambahTugasController::class, 'tugas'])->name('guru.tugas.tugas');
    Route::get('/guru-jadwal', [GuruController::class, 'jadwal'])->name('guru.jadwal');
    Route::get('/guru-forum', [PostController::class, 'tampilGuru'])->name('guru.forumdiskusi');
    Route::get('/guru-nilai', [ScoreController::class, 'lihat'])->name('guru.scores.index');

    //profile guruuuuu
    Route::get('/guru/profiles', [ProfileGuruController::class, 'show'])->name('guru.profiles.show');
    Route::get('/guru/profiles/edit/{id}', [ProfileGuruController::class, 'edit'])->name('guru.profiles.edit');
    Route::put('/guru/profiles/update/{id}', [ProfileGuruController::class, 'update'])->name('guru.profiles.update');

    // bagian Tugas 
    Route::get('/tugas', [TambahTugasController::class, 'tugas'])->name('guru.tugas.tugas');
    Route::get('/tugas/tambah', [TambahTugasController::class, 'tambah_tugas'])->name('guru.tugas.tambah');
    Route::post('/tugas/create', [TambahTugasController::class, 'create'])->name('guru.tugas.create');
    Route::get('/tugas/{id}/edit', [TambahTugasController::class, 'edit'])->name('guru.tugas.edit');
    Route::put('/tugas/{id}', [TambahTugasController::class, 'update'])->name('guru.tugas.update');
    Route::delete('/tugas/{id}', [TambahTugasController::class, 'destroy'])->name('guru.tugas.destroy');
    Route::get('/tugas/cari', [TambahTugasController::class, 'cari'])->name('guru.tugas.cari');

    //materi
    Route::get('/materi/cari', [GuruController::class, 'cari'])->name('materi.cari');
    Route::get('/materi/create', [GuruController::class, 'create'])->name('materi.create');
    Route::get('/materi/{id}/edit', [GuruController::class, 'edit'])->name('materi.edit');
    Route::delete('/materi/{id}', [GuruController::class, 'destroy'])->name('materi.destroy');



    // bagian tambah Materi
    Route::get('/guru-materi', [MateriController::class, 'materi'])->name('guru.materi');
    Route::get('/materi/cari', [MateriController::class, 'cari'])->name('materi.cari'); // Menggunakan MateriController
    Route::get('/materi/create', [MateriController::class, 'create'])->name('materi.create'); // Menggunakan MateriController
    Route::post('/materi', [MateriController::class, 'store'])->name('materi.store'); // Menambahkan rute untuk menyimpan materi
    Route::get('/materi/{id}/edit', [MateriController::class, 'edit'])->name('materi.edit'); // Menggunakan MateriController
    Route::put('/guru/materi/{id}', [MateriController::class, 'update'])->name('materi.update'); // Menambahkan rute untuk memperbarui materi
    Route::delete('/materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy'); // Menggunakan MateriController


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
    //forum

    Route::get('guru/forumdiskusi', [PostGuruController::class, 'index'])->name('guru.forumdiskusi');
    Route::post('guru/forumdiskusi/store', [PostGuruController::class, 'store'])->name('guru.posts.store');
    Route::delete('guru/forumdiskusi/{post}', [PostGuruController::class, 'destroy'])->name('guru.posts.destroy');
    
    Route::post('/guru/comment/store/{post}', [CommentGuruController::class, 'store'])->name('guru.comment.store');
    Route::post('/guru/forumdiskusi/{postId}/comment/{commentId}/reply', [CommentGuruController::class, 'replyComment'])->name('guru.comment.reply');
    Route::delete('/guru/comment/{comment}', [CommentGuruController::class, 'destroy'])->name('guru.comment.destroy');

});
Route::middleware(['auth','role:Orang Tua'])->group(function(){
    Route::get('/orangtua-dashboard', [OrangTuaController::class, 'index'])->name('orangtua.dashboard');
    Route::get('/ortu-nilai', [ScoreController::class, 'ortu'])->name('ortu.nilai');

    //profile
    Route::get('/profiles', [ProfilOrangtuaController::class, 'show'])->name('orangtua.profiles.show');
    Route::get('/profiles/{id}/edit', [ProfilOrangtuaController::class, 'edit'])->name('orangtua.profiles.edit');
    Route::put('/profiles/{id}', [ProfilOrangtuaController::class, 'update'])->name('orangtua.profiles.update');
});