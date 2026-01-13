<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\KategoriArtikel;
use Illuminate\Http\Request;

class ArtikelsController extends Controller
{
    public function index()
    {
    	$artikel = Artikel::with(['user','kategoriArtikel'])->latest()->paginate(4);
    	return view('artikel.index',compact('artikel'));
    }

    public function show(Artikel $artikel)
    {
        return view('artikel.show', compact('artikel'));
    }

    public function search(Request $request)
    {	
    	$artikel = Artikel::with(['user','kategoriArtikel'])->where(function($query) use ($request){
    		$query->where('judul','like','%'.$request->keyword.'%')
            ->orWhere('deskripsi','like','%'.$request->keyword.'%');
    	})->paginate(4);

    	return view('artikel.index',compact('artikel'));
    }   
}
