<?php

use Illuminate\Support\Facades\Route;

// ==================
// Frontend Controller
// ==================
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ArtikelsController;
use App\Http\Controllers\PendaftaranController;


Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/home',[HomeController::class,'index'])->name('home');

Route::get('/kontak',[HomeController::class,'kontak'])->name('kontak');


Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');




//artikel
Route::get('/artikel', [ArtikelsController::class,'index'])->name('artikel');
Route::get('/artikel/search',[ArtikelsController::class,'search'])->name('artikel.search');
Route::get('/artikel/{artikel:slug}',[ArtikelsController::class,'show'])->name('artikel.show');
 
//profil
Route::get('/profil-sekolah',[ProfilController::class,'index'])->name('profil.sekolah');
Route::get('/visi-misi',[ProfilController::class,'visi'])->name('profil.visi-misi');
Route::get('/fasilitas',[ProfilController::class,'fasilitas'])->name('profil.fasilitas');
route::get('/struktur-organisasi',[ProfilController::class,'struktur'])->name('profil.struktur-organisasi');
Route::get('/sejarah-singkat',[ProfilController::class,'sejarah'])->name('profil.sejarah-singkat');
Route::get('/staf-pengajar',[ProfilController::class,'pengajar'])->name('profil.staf-pengajar');
Route::get('/staf-pendidik',[ProfilController::class,'pendidik'])->name('profil.staf-pendidik');
