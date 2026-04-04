<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Ekstrakulikuler;
use App\Models\Ptn;
use Illuminate\Http\Request;

class KesiswaanController extends Controller
{
    public function alumni()
    {
        $alumni = Alumni::with('ptn')->get();
        return view('kesiswaan.alumni', compact('alumni'));
    }

    public function ekstrakulikuler()
    {
    	return view('kesiswaan.ekstrakulikuler', [
            'ekstrakulikuler' => Ekstrakulikuler::all(),
        ]);
    }
}
