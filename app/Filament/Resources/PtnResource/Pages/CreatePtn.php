<?php

namespace App\Filament\Resources\PtnResource\Pages;

use App\Filament\Resources\PtnResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePtn extends CreateRecord
{
    protected static string $resource = PtnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Kembali')
                ->color('gray') 
                ->url(fn() => $this->getResource()::getUrl('index')),
        ];
    }
}
