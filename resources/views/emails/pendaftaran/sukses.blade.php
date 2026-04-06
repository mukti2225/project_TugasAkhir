<x-mail::message>
# Halo {{ $pendaftaran->nama }},

Terima kasih telah melakukan pendaftaran sebagai calon Peserta Didik Baru Arif Rahman Hakim Tahun Ajaran 2025/2026.

Berikut adalah Nomor Pendaftaran Anda:

<x-mail::panel>
**{{ $pendaftaran->nomor_pendaftaran }}**
</x-mail::panel>

Harap simpan Nomor Pendaftaran ini baik-baik. Nomor ini akan digunakan untuk melakukan pengecekan pengumuman seleksi Anda pada halaman website kami.

<x-mail::button :url="url(route('pendaftaran.download', $pendaftaran->nomor_pendaftaran))">
    Download Formulir
</x-mail::button>


Jika Anda membutuhkan bantuan, silakan hubungi kami di (021) 1234-5678 atau WhatsApp di 0812-3456-7890.

Salam Hangat,<br>   
Panitia SPMB ARH
</x-mail::message>
