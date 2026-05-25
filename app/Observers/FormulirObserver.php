<?php

namespace App\Observers;

use App\Jobs\ValidateBerkasJob;
use App\Models\Formulir;

class FormulirObserver
{
    /**
     * Handle the Formulir "created" event.
     */
    public function created(Formulir $formulir): void
    {
        ValidateBerkasJob::dispatch($formulir);
    }

    /**
     * Handle the Formulir "updated" event.
     */
    public function updated(Formulir $formulir): void
    {
        $berkasChanged = $formulir->wasChanged([
            'ijazah_file_path',
            'kk_file_path',
            'akta_file_path',
        ]);

        if ($berkasChanged) {
            ValidateBerkasJob::dispatch($formulir);
        }
    }

    /**
     * Handle the Formulir "deleted" event.
     */
    public function deleted(Formulir $formulir): void
    {
        //
    }

    /**
     * Handle the Formulir "restored" event.
     */
    public function restored(Formulir $formulir): void
    {
        //
    }

    /**
     * Handle the Formulir "force deleted" event.
     */
    public function forceDeleted(Formulir $formulir): void
    {
        //
    }
}
