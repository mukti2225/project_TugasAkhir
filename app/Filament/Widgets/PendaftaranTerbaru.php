<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftaran;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PendaftaranTerbaru extends BaseWidget
{
    protected static ?int $sort = 4;
    
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->searchable(false)
            ->query(
                Pendaftaran::latest()->limit(6)
            )
            ->columns([
                TextColumn::make('nomor_pendaftaran')
                    ->label('No. Pendaftaran')
                    ->copyable()
                    ->weight('bold'),

                TextColumn::make('nama')
                    ->searchable(),

                TextColumn::make('program_studi')
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'IPA'    => 'success',
                        'IPS'    => 'warning',
                        'BAHASA' => 'info',
                        default  => 'gray',
                    }),

                TextColumn::make('status_verifikasi')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match($state) {
                        'belum_diverifikasi' => 'Belum',
                        'diverifikasi'       => 'Verified',
                        'ditolak'            => 'Ditolak',
                        default              => '-',
                    })
                    ->color(fn ($state) => match($state) {
                        'belum_diverifikasi' => 'gray',
                        'diverifikasi'       => 'success',
                        'ditolak'            => 'danger',
                        default              => 'gray',
                    }),

                TextColumn::make('status_penerimaan')
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'Menunggu' => 'warning',
                        'Diterima' => 'success',
                        'Ditolak'  => 'danger',
                        default    => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->since(),
            ]);
    }
}
