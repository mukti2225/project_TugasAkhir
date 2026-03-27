<?php

namespace App\Http\Controllers;

use App\Models\Ptn;
use App\Models\Artikel;
use App\Models\Gallery;
use App\Models\Statistik;
use App\Models\HeroSlider;

class HomeController extends Controller
{
    public function index()
    {
        return view('page.index', [
            'statistik' => Statistik::query()->first(),
            'artikel' => Artikel::with(['user','kategoriArtikel'])->latest()->take(4)->get(),
            'gallery' => Gallery::latest()->take(6)->get(),
            'ptn' => Ptn::all(),
            'sliders' => HeroSlider::where('is_active', true)
                ->orderBy('order')
                ->get(),
        ]);
    }

    public function kontak()
    {
        return view('page.kontak');
    }
}