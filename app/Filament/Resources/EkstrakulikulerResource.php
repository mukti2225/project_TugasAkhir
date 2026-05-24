<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EkstrakulikulerResource\Pages;
use App\Filament\Resources\EkstrakulikulerResource\RelationManagers;
use App\Models\Ekstrakulikuler;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EkstrakulikulerResource extends Resource
{
    protected static ?string $model = Ekstrakulikuler::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationGroup = 'Kesiswaan';

    protected static ?string $navigationLabel = 'Ekstrakulikuler';

    protected static ?string $pluralModelLabel = 'Daftar Ekstrakulikuler';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Ekstrakurikuler')
                    ->description('Kelola kegiatan ekstrakurikuler sekolah')
                    ->icon('heroicon-o-trophy')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Ekstrakurikuler')
                            ->required()
                            ->placeholder('Contoh: Basket')
                            ->prefixIcon('heroicon-m-trophy')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('foto')
                            ->label('Foto Ekstrakurikuler')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->directory('ekstrakulikuler-fotos')
                            ->acceptedFileTypes([
                                'image/*',
                            ])
                            ->panelLayout('compact')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->openable()
                            ->downloadable()
                            ->helperText('Upload foto kegiatan ekstrakurikuler')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('')
                    ->square()
                    ->size(100)
                    ->defaultImageUrl(url('/images/no-image.png')),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Ekstrakurikuler')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->lineClamp(2)
                    ->description(fn ($record) =>
                        'Ditambahkan ' .
                        $record->created_at?->diffForHumans()
                    ),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->iconButton(),
                Tables\Actions\EditAction::make()
                    ->iconButton(),
                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])

            ->emptyStateHeading('Belum ada ekstrakurikuler')
            ->emptyStateDescription('Tambahkan kegiatan ekstrakurikuler sekolah.')
            ->emptyStateIcon('heroicon-o-trophy');
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
            'index' => Pages\ListEkstrakulikulers::route('/'),
            'create' => Pages\CreateEkstrakulikuler::route('/create'),
            'edit' => Pages\EditEkstrakulikuler::route('/{record}/edit'),
        ];
    }
}
