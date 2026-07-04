<?php

use App\Http\Controllers\ArtikelsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KesiswaanController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/kontak',[HomeController::class,'kontak'])->name('kontak');

// Pendaftaran
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/pendaftaran/sukses/{id}', [PendaftaranController::class, 'success'])->name('pendaftaran.success');
Route::get('/pendaftaran/download/{id}', [PendaftaranController::class, 'download'])->name('pendaftaran.download');
Route::get('/pendaftaran/{nomor}', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
Route::put('/pendaftaran/{nomor}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');

Route::get('/pendaftaran/{nomor}/edit', [PendaftaranController::class, 'edit'])
    ->name('pendaftaran.edit');
Route::put('/pendaftaran/{nomor}/update', [PendaftaranController::class, 'update'])
    ->name('pendaftaran.update');
Route::post('/pendaftaran/{nomor}/verify-identity', [PendaftaranController::class, 'verifyIdentity'])
    ->name('pendaftaran.verifikasi-identitas');
Route::put('/pendaftaran/{nomor}/berkas', [PendaftaranController::class, 'updateBerkas'])
     ->name('pendaftaran.update-berkas');

// Cek status pendaftaran
Route::get('/cek-pendaftaran', [PendaftaranController::class, 'cek'])->name('pendaftaran.cek');
Route::post('/cek-pendaftaran', [PendaftaranController::class, 'cekHasil'])->name('pendaftaran.cek.hasil');

//Berita
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/artikel', [ArtikelsController::class,'index'])->name('artikel');
    Route::get('/artikel/search',[ArtikelsController::class,'search'])->name('artikel.search');
    Route::get('/artikel/{artikel:slug}',[ArtikelsController::class,'show'])->name('artikel.show');
    
    Route::get('/pengumuman', [PengumumanController::class,'index'])->name('pengumuman');
    Route::get('/pengumuman/search', [PengumumanController::class,'search'])->name('pengumuman.search');
    Route::get('/pengumuman/{pengumuman:slug}', [PengumumanController::class,'show'])->name('pengumuman.show');
});

//profil
Route::get('/sambutan',[ProfilController::class,'index'])->name('profil.sambutan');
Route::get('/visi-misi',[ProfilController::class,'visi'])->name('profil.visi-misi');
Route::get('/fasilitas',[ProfilController::class,'fasilitas'])->name('profil.fasilitas');
Route::get('/galeri-sekolah',[ProfilController::class,'galeri'])->name('profil.galeri-sekolah');
Route::get('/struktur-organisasi',[ProfilController::class,'struktur'])->name('profil.struktur-organisasi');
Route::get('/guru',[ProfilController::class,'pengajar'])->name('profil.guru');

//Kesiswaan
Route::get('/alumni',[KesiswaanController::class,'alumni'])->name('kesiswaan.alumni');
Route::get('/ekstrakulikuler',[KesiswaanController::class,'ekstrakulikuler'])->name('kesiswaan.ekstrakulikuler');

//Kontak
Route::post('/kritik-saran', [KontakController::class, 'store'])
    ->name('kritik-saran.store');
