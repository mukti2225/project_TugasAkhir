<?php

namespace App\Filament\Resources\PtnResource\Pages;

use App\Filament\Resources\PtnResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPtns extends ListRecords
{
    protected static string $resource = PtnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
