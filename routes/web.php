<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentGuruController;
use App\Http\Controllers\CommentSiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalguruController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\OrangTuaController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostGuruController;
use App\Http\Controllers\PostSiswaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\JadwalguruController;
use App\Http\Controllers\NIlaidiGuruController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TambahController;
use App\Http\Controllers\TambahGuruController;
use App\Http\Controllers\TambahOrangtuaController;
use App\Http\Controllers\TambahTugasController;
use App\Models\Siswa;
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

    //profile
    Route::get('/profiles', [ProfileController::class, 'show'])->name('profiles.show');
    Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');
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
    Route::get('/admin/materi', [AdminController::class, 'materiAdmin'])->name('admin.materi.index');
        Route::get('/admin/materi/create', [AdminController::class, 'createMateri'])->name('adminMateri.create');
        Route::post('/admin/materi/store', [AdminController::class, 'storeAdmin'])->name('adminMateri.store');
        Route::get('/admin/materi/{id}/edit', [AdminController::class, 'edittMateri'])->name('adminMateri.edit');
        Route::put('/admin/materi/{id}', [AdminController::class, 'updateMateri'])->name('adminMateri.update');
        Route::delete('/admin/materi/{id}', [AdminController::class, 'destroyMateri'])->name('adminMateri.destroy');
        Route::get('/admin/materi/cari', [AdminController::class, 'cariMateri'])->name('materiAdmin.cari');


        //forum
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

        
        Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('posts.comment');
        Route::post('/posts/{post}/comment/{comment}/reply', [CommentController::class, 'replyComment'])->name('posts.comment.reply');
        Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.delete');
        



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
    //profile
    Route::get('/profiles', [ProfileController::class, 'show'])->name('profiles.show');

    // Menampilkan form edit profil
    Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');

    // Mengupdate profil pengguna
    Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');
    //siswa melihat materi
    Route::get('/siswa-materi-lihat', [MateriController::class, 'lihatMateri_siswa'])->name('siswa.lihatmateri');

        //forum
    Route::get('/siswa/forumdiskusi', [PostSiswaController::class, 'index'])->name('siswa.forumdiskusi');
    Route::post('/siswa/forumdiskusi', [PostSiswaController::class, 'store'])->name('siswa.post.store');
    Route::delete('/siswa/forumdiskusi/{post}', [PostSiswaController::class, 'destroy'])->name('siswa.post.destroy');

        
    Route::post('/siswa/forumdiskusi/{post}/comment', [CommentSiswaController::class, 'store'])->name('siswa.comment.store');
    Route::post('/siswa/forumdiskusi/{post}/comment/{comment}/reply', [CommentSiswaController::class, 'replyComment'])->name('siswa.comment.reply');
    Route::delete('/siswa/forumdiskusi/comment/{comment}', [CommentSiswaController::class, 'destroy'])->name('siswa.comment.destroy');
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

    //materi guru
    Route::get('/guru/tambah-tugas', [TambahTugasController::class, 'tambah_tugas'])->name('guru.addTugas');
    Route::post('/guru/tambah-tugas', [TambahTugasController::class, 'create'])->name('guru.storetugas');
    Route::get('/guru-edittugas', [TambahTugasController::class, 'edit'])->name('edit_tugas');
    Route::delete('/guru/tugas/{id}', [TambahTugasController::class, 'destroy'])->name('guru.tugas.destroy');
    Route::get('/materi/cari', [GuruController::class, 'cari'])->name('materi.cari');
    Route::get('/materi/create', [GuruController::class, 'create'])->name('materi.create');
    Route::get('/materi/{id}/edit', [GuruController::class, 'edit'])->name('materi.edit');
    Route::delete('/materi/{id}', [GuruController::class, 'destroy'])->name('materi.destroy');




        //CRUD NILAI
        Route::prefix('guru')->group(function () {
            Route::get('/scores', [ScoreController::class, 'index'])->name('scores.index');
            Route::get('/scores/create', [ScoreController::class, 'create'])->name('scores.create');
            Route::post('/scores', [ScoreController::class, 'store'])->name('scores.store');
            Route::get('/scores/{id}/edit', [ScoreController::class, 'edit'])->name('scores.edit');
            Route::put('/scores/{id}', [ScoreController::class, 'update'])->name('scores.update');
            Route::delete('/scores/{id}', [ScoreController::class, 'destroy'])->name('scores.destroy');
            Route::get('/scores/cari', [ScoreController::class, 'cari'])->name('scores.cari');


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
    Route::post('guru/forumdiskusi/store', [PostGuruController::class, 'store'])->name('guru.forumdiskusi.store');
    Route::delete('guru/forumdiskusi/{post}', [PostGuruController::class, 'destroy'])->name('guru.forumdiskusi.destroy');
    Route::post('/guru/forumdiskusi/{post}/comment', [CommentGuruController::class, 'store'])->name('guru.comment.store');
    Route::post('/guru/forumdiskusi/{postId}/comment/{commentId}/reply', [CommentGuruController::class, 'replyComment'])->name('guru.comment.reply');
    Route::delete('/guru/comment/{comment}', [CommentGuruController::class, 'destroy'])->name('guru.comment.destroy');

});
Route::middleware(['auth','role:Orang Tua'])->group(function(){
    Route::get('/orangtua-dashboard', [OrangTuaController::class, 'index'])->name('orangtua.dashboard');
    Route::get('/ortu-nilai', [ScoreController::class, 'ortu'])->name('ortu.nilai');
});
