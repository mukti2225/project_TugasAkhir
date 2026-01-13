<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\HeroSlider;
use App\Models\Gallery;
use App\Models\Statistik;

class HomeController extends Controller
{
    public function index()
    {
        return view('page.index', [
            'statistik' => Statistik::query()->first(),
            'artikel' => Artikel::with(['user','kategoriArtikel'])->latest()->take(3)->get(),
            'gallery' => Gallery::latest()->take(6)->get(),
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
