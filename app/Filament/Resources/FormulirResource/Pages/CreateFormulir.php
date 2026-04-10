<?php

namespace App\Filament\Resources\FormulirResource\Pages;

use App\Filament\Resources\FormulirResource;
use App\Mail\PendaftaranSukses;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;

class CreateFormulir extends CreateRecord
{
    protected static string $resource = FormulirResource::class;

    protected static ?string $title = 'Tambah Formulir SPMB';

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            $this->getCancelFormAction(),
        ];
    }
}
