<?php

namespace App\Filament\Resources\TenagaKependidikanResource\Pages;

use App\Filament\Resources\TenagaKependidikanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTenagaKependidikan extends EditRecord
{
    protected static string $resource = TenagaKependidikanResource::class;

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
