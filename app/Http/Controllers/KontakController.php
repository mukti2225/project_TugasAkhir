<?php

namespace App\Http\Controllers;

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
        KritikSaran::create([
            'nama'   => $validated['nama'],
            'email'  => $validated['email'],
            'subjek' => $validated['subjek'],
            'pesan'  => $validated['pesan'],
        ]);

        // KIRIM EMAIL
        Mail::raw(
            "Pesan Kritik & Saran\n\n" .
            "Nama: {$validated['nama']}\n" .
            "Email: {$validated['email']}\n" .
            "Subjek: {$validated['subjek']}\n\n" .
            "Pesan:\n{$validated['pesan']}",
            function ($message) use ($validated) {
                $message->to('raehanmukti03@gmail.com')
                        ->subject('Kritik & Saran Baru');
            }
        );

        // REDIRECT
        return back()->with('success', 'Pesan berhasil dikirim!');
    }
}
