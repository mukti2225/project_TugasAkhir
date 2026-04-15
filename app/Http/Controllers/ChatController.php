<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $input = strtolower($request->message);

        // 🔥 Rule-based (FAQ sederhana)
        if (str_contains($input, 'jadwal')) {
            $reply = "Jadwal pendaftaran dibuka bulan Juni.";
        } elseif (str_contains($input, 'biaya')) {
            $reply = "Biaya pendaftaran Rp 200.000.";
        } elseif (str_contains($input, 'syarat')) {
            $reply = "Syarat: fotokopi rapor, KK, dan akta lahir.";
        } else {
            $reply = "Maaf, pertanyaan belum tersedia.";
        }

        return response()->json([
            'reply' => $reply
        ]);
    }
}
