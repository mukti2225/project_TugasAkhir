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

            'ijazah_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'kk_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'akta_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'nik.unique' => 'Maaf, NIK ini sudah pernah didaftarkan.',
            'nik.digits' => 'Format NIK tidak valid. Harus berjumlah 16 digit angka.',
            'nisn.unique' => 'Maaf, NISN ini sudah pernah didaftarkan.',
            'nisn.digits' => 'Format NISN tidak valid. Harus berjumlah 10 digit angka.',
        ]);

        $data = $request->all();
        
        // ================== IJAZAH ==================
        if ($request->hasFile('ijazah_file')) {
            $file = $request->file('ijazah_file');

            $path = $file->store('berkas/ijazah', 'public');

            $data['ijazah_file_path'] = $path;
            $data['ijazah_file_name'] = $file->getClientOriginalName();
        }

        // ================== KK ==================
        if ($request->hasFile('kk_file')) {
            $file = $request->file('kk_file');

            $path = $file->store('berkas/kk', 'public');

            $data['kk_file_path'] = $path;
            $data['kk_file_name'] = $file->getClientOriginalName();
        }

        // ================== AKTA ==================
        if ($request->hasFile('akta_file')) {
            $file = $request->file('akta_file');

            $path = $file->store('berkas/akta', 'public');

            $data['akta_file_path'] = $path;
            $data['akta_file_name'] = $file->getClientOriginalName();
        }
        // user_id required in database
        $data['user_id'] = auth()->id() ?? 1;
        
        // SIMPAN
        $pendaftaran = Pendaftaran::create($data);

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

        $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $pendaftaran->nama ?? 'formulir');

         $pdf = Pdf::loadView('pdf.formulir', [
            'data' => $pendaftaran,
        ])->setPaper('A4', 'portrait');

        return $pdf->download("Formulir_{$safeName}.pdf");
    }
}
