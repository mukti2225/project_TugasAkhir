<?php

namespace App\Filament\Resources\KritikSaranResource\Pages;

use App\Filament\Resources\KritikSaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKritikSarans extends ListRecords
{
    protected static string $resource = KritikSaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('refresh')
                ->label('Refresh Data')
                ->icon('heroicon-o-arrow-path')
                ->color('primary')
                ->action(function () {
                    $this->dispatch('$refresh');
                }),
        ];
    }
}
