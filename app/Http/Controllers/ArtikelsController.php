<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\KategoriArtikel;
use Illuminate\Http\Request;

class ArtikelsController extends Controller
{
    public function index(Request $request)
    {
    	$artikel = Artikel::with(['user','kategoriArtikel'])
            ->when($request->kategori, function ($query) use ($request) {
                $query->where('kategori_artikel_id', $request->kategori);
            })
            ->latest()
            ->paginate(30)
            ->withQueryString();
        
        $kategori = KategoriArtikel::all();
        
    	return view('berita.artikel.index',compact('artikel', 'kategori'));
    }

    public function show(Artikel $artikel)
    {
        return view('berita.artikel.show', compact('artikel'));
    }

    public function search(Request $request)
    {	
    	$artikel = Artikel::with(['user','kategoriArtikel'])
            ->where(function($query) use ($request){
                $query->where('judul','like','%'.$request->keyword.'%')
                    ->orWhere('deskripsi','like','%'.$request->keyword.'%');
    	})
        ->latest()
        ->paginate(30)
        ->withQueryString();

        $kategori = KategoriArtikel::all();

    	return view('berita.artikel.index',compact('artikel', 'kategori'));
    }   
}
