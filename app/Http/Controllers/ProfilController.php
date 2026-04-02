<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Guru;
use App\Models\Statistik;
use App\Models\TenagaKependidikan;
use App\Models\VisiMisi;

class ProfilController extends Controller
{
    public function index()
    {
    	return view('profile.sambutan', [
            'statistik' => Statistik::select('photo', 'name', 'position', 'sambutan')->first(),
        ]);
    }

    public function visi()
    {
    	return view('profile.visi-misi', [
            'visiMisi' => VisiMisi::select('visi', 'misi')->first(),
        ]);
    }

    public function struktur()
    {
    	return view('profile.struktur');
    }

    public function fasilitas()
    {
    	return view('profile.fasilitas', [
            'fasilitas' => Fasilitas::select('nama', 'foto')->get(),
        ]);
    }

    public function pengajar()
    {
    	return view('profile.guru', [
            'guru' => Guru::select('nama', 'foto')->get(),
        ]);
    }

    public function pendidik()
    {
    	return view('profile.staff', [
            'staff' => TenagaKependidikan::select('nama', 'foto')->get(),
        ]);
    }
}
