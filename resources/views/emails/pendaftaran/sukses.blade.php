<x-mail::message>
    # Halo {{ $pendaftaran->nama }},

    Terima kasih telah melakukan pendaftaran sebagai calon Peserta Didik Baru di **SMA Arif Rahman Hakim** Tahun Ajaran
    2025/2026.

    Pendaftaran Anda telah berhasil kami terima. Berikut Nomor Pendaftaran Anda:

    <x-mail::panel>
        <div style="text-align:center;">
            <div style="font-size:13px; color:#666;">
                Nomor Pendaftaran
            </div>

            <div style="font-size:28px; font-weight:bold; color:#166534; margin-top:8px;">
                {{ $pendaftaran->nomor_pendaftaran }}
            </div>
        </div>
    </x-mail::panel>

    Mohon simpan nomor tersebut dengan baik karena akan digunakan untuk:
    - pengecekan status pendaftaran,
    - proses verifikasi,
    - dan pengumuman hasil seleksi.

    <x-mail::button :url="url(route('pendaftaran.download', $pendaftaran->nomor_pendaftaran))" color="success">
        Download Formulir
    </x-mail::button>

    Jika ada data yang kurang sesuai atau mengalami kendala selama proses pendaftaran, jangan ragu untuk menghubungi
    panitia SPMB kami.

    📞 (021) 1234-5678
    📱 0812-3456-7890

    Terima kasih atas kepercayaan Anda kepada **SMA Arif Rahman Hakim** sebagai pilihan pendidikan putra/putri Anda.

    Salam hangat,<br>
    **Panitia SPMB ARH**
</x-mail::message>
