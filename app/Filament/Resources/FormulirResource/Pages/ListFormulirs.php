<?php

namespace App\Filament\Resources\FormulirResource\Pages;

use App\Exports\FormulirExport;
use App\Filament\Resources\FormulirResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListFormulirs extends ListRecords
{
    protected static string $resource = FormulirResource::class;

    protected static ?string $title = 'Data Formulir SPMB';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export_excel')
                ->label('Export Excel')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->visible(fn () => auth()->user()?->hasRole('admin'))
                ->action(fn () => Excel::download(new FormulirExport, 'formulir_spmb.xlsx')),
                
            Actions\CreateAction::make(),
        ];
    }
}
