<?php

namespace App\Filament\User\Resources\PendaftaranResource\Pages;

use App\Filament\User\Resources\PendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendaftarans extends ListRecords
{
    protected static string $resource = PendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
