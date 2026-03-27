<?php

use App\Http\Controllers\ArtikelsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KesiswaanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;


// Auth::routes(['verify'=>true]);

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/home',[HomeController::class,'index'])->name('home');

Route::get('/kontak',[HomeController::class,'kontak'])->name('kontak');


Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran');

Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/artikel', [ArtikelsController::class,'index'])->name('artikel');
    Route::get('/artikel/search',[ArtikelsController::class,'search'])->name('artikel.search');
    Route::get('/artikel/{artikel:slug}',[ArtikelsController::class,'show'])->name('artikel.show');
});

 
//profil
Route::get('/sambutan',[ProfilController::class,'index'])->name('profil.sambutan');
Route::get('/visi-misi',[ProfilController::class,'visi'])->name('profil.visi-misi');
Route::get('/fasilitas',[ProfilController::class,'fasilitas'])->name('profil.fasilitas');
Route::get('/struktur-organisasi',[ProfilController::class,'struktur'])->name('profil.struktur-organisasi');
Route::get('/guru',[ProfilController::class,'pengajar'])->name('profil.guru');
Route::get('/staf-pendidik',[ProfilController::class,'pendidik'])->name('profil.staf');

//kesiswaan
Route::get('/alumni',[KesiswaanController::class,'alumni'])->name('kesiswaan.alumni');
Route::get('/ekstrakulikuler',[KesiswaanController::class,'ekstrakulikuler'])->name('kesiswaan.ekstrakulikuler');
