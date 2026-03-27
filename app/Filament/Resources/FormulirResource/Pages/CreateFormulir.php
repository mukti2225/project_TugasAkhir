<?php

namespace App\Filament\Resources\FormulirResource\Pages;

use App\Filament\Resources\FormulirResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFormulir extends CreateRecord
{
    protected static string $resource = FormulirResource::class;

    protected static ?string $title = 'Formulir SPMB';

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            $this->getCancelFormAction(),
        ];
    }
}
