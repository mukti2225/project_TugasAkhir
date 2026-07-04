<?php

namespace App\Jobs;

use App\Services\OcrValidationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ValidateBerkasJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Model $model)
    {
        //
    }

    public function handle(OcrValidationService $ocr): void
    {
        $results = [];
        if ($this->model->ijazah_file_path) {
            $results['ijazah'] = $ocr->validateIjazah(
                $this->model->ijazah_file_path
            );
        }

        if ($this->model->kk_file_path) {
            $results['kk'] = $ocr->validateKartuKeluarga(
                $this->model->kk_file_path
            );
        }

        if ($this->model->akta_file_path) {
            $results['akta'] = $ocr->validateAkta(
                $this->model->akta_file_path
            );
        }

        $allValid = !empty($results) && collect($results)->every(fn($r) => $r['valid']);
        $statusVerifikasi = $allValid ? 'diverifikasi' : 'ditolak';
        $this->model->update([
            'ocr_results'       => $results,
            'ocr_status'        => $allValid ? 'passed' : 'failed',
            'ocr_checked_at'    => now(),
            'status_verifikasi' => $statusVerifikasi,
        ]);
    }
}
