<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Artikel;
use App\Models\Gallery;
use App\Models\HeroSlider;
use App\Models\Ptn;
use App\Models\Statistik;

class HomeController extends Controller
{
    public function index()
    {
        return view('page.index', [
            'statistik' => Statistik::query()->first(),
            'artikel' => Artikel::with(['user'])
                ->latest()
                ->take(4)
                ->get(),
            'gallery' => Gallery::latest()
                ->take(6)
                ->get(),
            'ptn' => Ptn::all(),
            'sliders' => HeroSlider::where('is_active', true)
                ->orderBy('order')
                ->get(),
            'agendas' => Agenda::where('is_active', true)
                ->orderBy('tanggal')
                ->get(),
        ]);
    }
    
    public function kontak()
    {
        return view('page.kontak');
    }

}