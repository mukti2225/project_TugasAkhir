<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KritikSaranResource\Pages;
use App\Filament\Resources\KritikSaranResource\RelationManagers;
use App\Models\KritikSaran;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Mail;

class KritikSaranResource extends Resource
{
    protected static ?string $model = KritikSaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Kritik & Saran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Placeholder::make('nama')
                    ->label('Nama Pengirim')
                    ->content(fn ($record) => $record?->nama),

                Placeholder::make('email')
                    ->label('Email Pengirim')
                    ->content(fn ($record) => $record?->email),

                Placeholder::make('subjek')
                    ->label('Subjek')
                    ->content(fn ($record) => ucfirst($record?->subjek)),

                Placeholder::make('pesan')
                    ->label('Isi Pesan')
                    ->content(fn ($record) => $record?->pesan)
                    ->columnSpanFull(),

                Textarea::make('balasan')
                    ->label('Balasan Admin')
                    ->rows(5)
                    ->placeholder('Tulis balasan untuk pengirim...')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('email')
                    ->searchable(),

                TextColumn::make('subjek')
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'kritik'     => 'danger',
                        'saran'      => 'success',
                        'pertanyaan' => 'info',
                        default      => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                TextColumn::make('pesan')
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->pesan),

                TextColumn::make('dibalas_at')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Sudah Dibalas' : 'Belum Dibalas')
                    ->color(fn ($state) => $state ? 'success' : 'warning'),

                TextColumn::make('created_at')
                    ->label('Dikirim')
                    ->since(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Action::make('balas')
                    ->label('Balas')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('primary')
                    ->form([
                        Textarea::make('balasan')
                            ->label('Isi Balasan')
                            ->required()
                            ->rows(6)
                            ->placeholder('Tulis balasan...'),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'balasan'    => $data['balasan'],
                            'dibalas_at' => now(),
                        ]);

                        // Kirim email balasan ke pengirim
                        Mail::to($record->email)
                            ->send(new \App\Mail\BalasanKritikSaranMail($record));

                        \Filament\Notifications\Notification::make()
                            ->title('Balasan berhasil dikirim')
                            ->success()
                            ->send();
                    })
                    ->visible(fn ($record) => !$record->dibalas_at),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('subjek')
                    ->options([
                        'kritik'     => 'Kritik',
                        'saran'      => 'Saran',
                        'pertanyaan' => 'Pertanyaan',
                        'lainnya'    => 'Lainnya',
                    ]),
            ])
            ->emptyStateHeading('Belum ada pesan masuk')
            ->emptyStateIcon('heroicon-o-chat-bubble-left-right');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKritikSarans::route('/'),
            'create' => Pages\CreateKritikSaran::route('/create'),
            'edit' => Pages\EditKritikSaran::route('/{record}/edit'),
        ];
    }
}
