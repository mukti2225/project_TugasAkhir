<?php

namespace App\Observers;

use App\Jobs\ValidateBerkasJob;
use App\Mail\StatusPenerimaan;
use App\Mail\StatusVerifikasi;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Mail;

class PendaftaranObserver
{
    /**
     * Handle the Pendaftaran "created" event.
     */
    public function created(Pendaftaran $pendaftaran): void
    {
        ValidateBerkasJob::dispatch($pendaftaran);
    }

    /**
     * Handle the Pendaftaran "updated" event.
     */
    public function updated(Pendaftaran $pendaftaran): void
    {
        $berkasChanged = $pendaftaran->wasChanged([
            'ijazah_file_path',
            'kk_file_path',
            'akta_file_path',
        ]);

        if ($berkasChanged) {
            ValidateBerkasJob::dispatch($pendaftaran);
        }

        // Notifikasi verifikasi berkas
        if (
            $pendaftaran->wasChanged('status_verifikasi') &&
            $pendaftaran->status_verifikasi !== 'belum_diverifikasi'
        ) {
            Mail::to($pendaftaran->email)
                ->queue(new StatusVerifikasi($pendaftaran));
        }

        // Notifikasi status penerimaan
        if (
            $pendaftaran->wasChanged('status_penerimaan') &&
            $pendaftaran->status_penerimaan !== 'Menunggu'
        ) {
            Mail::to($pendaftaran->email)
                ->queue(new StatusPenerimaan($pendaftaran));
        }
    }

    /**
     * Handle the Pendaftaran "deleted" event.
     */
    public function deleted(Pendaftaran $pendaftaran): void
    {
        //
    }

    /**
     * Handle the Pendaftaran "restored" event.
     */
    public function restored(Pendaftaran $pendaftaran): void
    {
        //
    }

    /**
     * Handle the Pendaftaran "force deleted" event.
     */
    public function forceDeleted(Pendaftaran $pendaftaran): void
    {
        //
    }
}
