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

                Placeholder::make('dibalas_at')
                    ->label('Dibalas pada')
                    ->content(fn ($record) => $record?->dibalas_at?->format('d M Y, H:i') . ' WIB')
                    ->visible(fn ($record) => (bool) $record?->dibalas_at)
                    ->columnSpanFull(),

                Textarea::make('balasan')
                    ->label('Balasan Admin')
                    ->rows(6)
                    ->placeholder('Tulis balasan untuk pengirim...')
                    ->disabled(fn ($record) => (bool) $record?->dibalas_at)
                    ->helperText(fn ($record) => $record?->dibalas_at
                        ? 'Pesan ini sudah dibalas pada ' . $record->dibalas_at->format('d M Y, H:i')
                        : 'Isi balasan lalu klik "Kirim Balasan"'
                    )
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
                
                TextColumn::make('balasan')
                    ->label('Balasan')
                    ->limit(40)
                    ->placeholder('—')
                    ->tooltip(fn ($record) => $record->balasan),

                TextColumn::make('dibalas_at')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Sudah Dibalas' : 'Belum Dibalas')
                    ->color(fn ($state) => $state ? 'success' : 'warning'),

                TextColumn::make('dibalas_at')
                    ->label('Dibalas')
                    ->since()
                    ->placeholder('Belum dibalas')
                    ->toggleable(),

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
                    ->requiresConfirmation()
                    ->modalHeading('Balas Pesan')
                    ->modalDescription(fn ($record) => "Balas pesan dari {$record->nama} ({$record->email})")
                    ->modalSubmitActionLabel('Kirim Balasan')
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

                        try {
                            Mail::to($record->email)
                                ->queue(new \App\Mail\BalasanKritikSaranMail($record));

                            \Filament\Notifications\Notification::make()
                                ->title('Balasan berhasil dikirim')
                                ->body("Email terkirim ke {$record->email}")
                                ->success()
                                ->send();

                        } catch (\Exception $e) {
                            \Filament\Notifications\Notification::make()
                                ->title('Gagal mengirim email')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
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
                Tables\Filters\Filter::make('belum_dibalas')
                    ->label('Belum Dibalas')
                    ->query(fn ($query) => $query->whereNull('dibalas_at'))
                    ->toggle(),

                Tables\Filters\Filter::make('sudah_dibalas')
                    ->label('Sudah Dibalas')
                    ->query(fn ($query) => $query->whereNotNull('dibalas_at'))
                    ->toggle(),
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

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        $count = KritikSaran::whereNull('dibalas_at')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKritikSarans::route('/'),
            'view'  => Pages\ViewKritikSaran::route('/{record}'),
        ];
    }
}
