<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function create()
    {
        return view('pendaftaran.form');
    }

    public function store(Request $request)
    {
        // VALIDASI
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'nik' => 'required|digits:16|unique:pendaftarans,nik',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
          
            'nisn' => 'required|digits:10|unique:pendaftarans,nisn',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
        ], [
            'nik.unique' => 'Maaf, NIK ini sudah pernah didaftarkan.',
            'nik.digits' => 'Format NIK tidak valid. Harus berjumlah 16 digit angka.',
            'nisn.unique' => 'Maaf, NISN ini sudah pernah didaftarkan.',
            'nisn.digits' => 'Format NISN tidak valid. Harus berjumlah 10 digit angka.',
        ]);

        $data = $request->all();
        // user_id required in database
        $data['user_id'] = auth()->id() ?? 1;
        
        // Buat nomor pendaftaran dari tanggal lahir (format: ddmmyyyy)
        $data['nomor_pendaftaran'] = date('dmY', strtotime($data['tanggal_lahir']));

        // SIMPAN
        $pendaftaran = Pendaftaran::create($data);

        // Kirim Email ke pendaftar
        try {
            \Illuminate\Support\Facades\Mail::to($data['email'])->send(new \App\Mail\PendaftaranSukses($pendaftaran));
        } catch (\Exception $e) {
            // Log error if mail fails, but continue to success page
            \Illuminate\Support\Facades\Log::error('Gagal mengirim email pendaftaran: ' . $e->getMessage());
        }

        // Beri otorisasi untuk bisa masuk ke halaman success
        session(['nomor_pendaftaran' => $pendaftaran->id]);

        return redirect()->route('pendaftaran.success', ['id' => $pendaftaran->id]);
    }

    public function success($id)
    {
        // Pastikan hanya bisa akses halaman sukses jika baru saja mendaftar
        if (session('nomor_pendaftaran') != $id) {
            return redirect()->route('pendaftaran');
        }

        $pendaftaran = Pendaftaran::findOrFail($id);

        return view('pendaftaran.success', compact('pendaftaran'));
    }

    public function cek()
    {
        return view('pendaftaran.cek');
    }

    public function cekHasil(Request $request)
    {
        $request->validate([
            'nomor_pendaftaran' => 'required',
        ], [
            'nomor_pendaftaran.required' => 'Nomor Pendaftaran wajib diisi.',
        ]);

        $pendaftaran = Pendaftaran::where('nomor_pendaftaran', $request->nomor_pendaftaran)->first();

        if (!$pendaftaran) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nomor_pendaftaran' => 'Nomor Pendaftaran tidak ditemukan. Anda belum melakukan pendaftaran atau nomor salah.']);
        }

        return view('pendaftaran.cek', compact('pendaftaran'));
    }

    public function download($id)
    {
        $pendaftaran = Pendaftaran::Where('nomor_pendaftaran', $id)->firstOrFail();

        // Amankan nama file
        $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $pendaftaran->nama ?? 'formulir');

         $pdf = Pdf::loadView('pdf.formulir', [
            'data' => $pendaftaran,
        ])->setPaper('A4', 'portrait');

        return $pdf->download("Formulir_{$safeName}.pdf");
    }
}
