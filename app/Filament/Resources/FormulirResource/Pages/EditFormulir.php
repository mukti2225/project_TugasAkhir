<?php

namespace App\Filament\Resources\FormulirResource\Pages;

use App\Filament\Resources\FormulirResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormulir extends EditRecord
{
    protected static string $resource = FormulirResource::class;

    protected static ?string $title = 'Edit Formulir SPMB';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('back')
                ->label('Kembali')
                ->color('gray') 
                ->url(fn() => $this->getResource()::getUrl('index')),
        ];
    }
}
