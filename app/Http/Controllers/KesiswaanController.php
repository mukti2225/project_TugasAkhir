<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KesiswaanController extends Controller
{
    public function alumni()
    {
    	return view('kesiswaan.alumni');
    }

    public function ekstrakulikuler()
    {
    	return view('kesiswaan.ekstrakulikuler');
    }
}
