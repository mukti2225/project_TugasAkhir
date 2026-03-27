<?php

namespace App\Http\Controllers;

use App\Models\Statistik;

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
    	return view('profile.visi-misi');
    }

    public function struktur()
    {
    	return view('profile.struktur');
    }

    public function fasilitas()
    {
    	return view('profile.fasilitas');
    }

    public function pengajar()
    {
    	return view('profile.guru');
    }

    public function pendidik()
    {
    	return view('profile.staff');
    }
}
