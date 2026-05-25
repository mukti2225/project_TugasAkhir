<?php

namespace App\Http\Controllers;

use App\Mail\KritikSaranMail;
use App\Models\KritikSaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class KontakController extends Controller
{
    public function store(Request $request)
    {
        // VALIDASI
        $validated = $request->validate([
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan'  => 'required|string',
        ]);

        // SIMPAN KE DATABASE
        $kritikSaran = KritikSaran::create($validated);

        // KIRIM EMAIL
        Mail::to('raehanmukti03@gmail.com')
            ->queue(new KritikSaranMail($kritikSaran));

        // REDIRECT
        return back()->with('success', 'Pesan berhasil dikirim!');
    }
}
