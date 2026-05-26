<?php

namespace App\Filament\Resources\EkstrakulikulerResource\Pages;

use App\Filament\Resources\EkstrakulikulerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEkstrakulikuler extends CreateRecord
{
    protected static string $resource = EkstrakulikulerResource::class;

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
