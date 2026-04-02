<?php

namespace App\Filament\Resources\StatistikResource\Pages;

use App\Filament\Resources\StatistikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatistik extends EditRecord
{
    protected static string $resource = StatistikResource::class;
    
    protected static ?string $title = 'Edit Sambutan Sekolah';

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
