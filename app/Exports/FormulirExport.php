<?php

namespace App\Exports;

use App\Models\Formulir;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FormulirExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Formulir::with('user')->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Agama',
            'Anak Ke',
            'Status',

            'Alamat Lengkap',
            'No Telp Ortu',
            'No Telp Siswa',
            'Tinggal',
            'Jarak Sekolah',

            'Pendidikan',
            'NISN',
            'Ijazah',
            'Asal Sekolah',
            'Pindahan',
            'Program Studi',

            'Nama Ayah',
            'TTL Ayah',
            'Agama Ayah',
            'Pendidikan Ayah',
            'Pekerjaan Ayah',
            'Penghasilan Ayah',
            'Alamat Ayah',
            'No Telp Ayah',

            'Nama Ibu',
            'TTL Ibu',
            'Agama Ibu',
            'Pendidikan Ibu',
            'Pekerjaan Ibu',
            'Penghasilan Ibu',
            'Alamat Ibu',
            'No Telp Ibu',

            'Nama Wali',
            'TTL Wali',
            'Agama Wali',
            'Pendidikan Wali',
            'Pekerjaan Wali',
            'Penghasilan Wali',
            'Alamat Wali',
            'No Telp Wali',

        ];
    }

    public function map($row): array
    {
        return [
            $row->nama,
            "'" . $row->nik,
            $row->tempat_lahir,
            $row->tanggal_lahir?->format('d-m-Y'),
            $row->jenis_kelamin,
            $row->agama,
            $row->anak,
            $row->status,

            implode(', ', array_filter([
                $row->alamat,
                'Jl. ' . $row->jalan,
                'RT/RW ' . $row->rt_rw,
                $row->kelurahan,
                $row->kecamatan,
                $row->kota,
            ])),
            $row->nomor_telepon,
            $row->nomor_telepon_siswa,
            $row->tinggal,
            $row->jarak_sekolah,

            $row->pendidikan,
            "'" . $row->nisn,
            $row->ijazah,
            $row->asal_sekolah,
            $row->pindahan,
            $row->program_studi,

            $row->nama_ayah,
            $row->tempat_lahir_ayah . ', ' . optional($row->tanggal_lahir_ayah)->format('d-m-Y'),
            $row->agama_ayah,
            $row->pendidikan_ayah,
            $row->pekerjaan_ayah,
            $row->penghasilan_ayah,
            $row->alamat_ayah,
            $row->nomor_telepon_ayah,

            $row->nama_ibu,
            $row->tempat_lahir_ibu . ', ' . optional($row->tanggal_lahir_ibu)->format('d-m-Y'),
            $row->agama_ibu,
            $row->pendidikan_ibu,
            $row->pekerjaan_ibu,
            $row->penghasilan_ibu,
            $row->alamat_ibu,
            $row->nomor_telepon_ibu,

            $row->nama_wali,
            $row->tempat_lahir_wali . ', ' . optional($row->tanggal_lahir_wali)->format('d-m-Y'),
            $row->agama_wali,
            $row->pendidikan_wali,
            $row->pekerjaan_wali,
            $row->penghasilan_wali,
            $row->alamat_wali,
            $row->nomor_telepon_wali,

        ];
    }
}
