<?php

namespace App\Filament\Resources\FasilitasResource\Pages;

use App\Filament\Resources\FasilitasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFasilitas extends EditRecord
{
    protected static string $resource = FasilitasResource::class;

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
