<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;


class PendaftaranController extends Controller
{
    public function create()
    {
        return view('pendaftaran.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nisn' => 'required|unique:pendaftarans',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'asal_sekolah' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'no_hp_orang_tua' => 'required',
            'alamat' => 'required',
        ]);

        Pendaftaran::create(
            array_merge(
                $request->all(),
                ['user_id' => auth()->id()]
            )
        );

        return redirect()->back()->with('success', 'Pendaftaran berhasil dikirim');
    }
}
