<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriArtikelResource\Pages;
use App\Models\KategoriArtikel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class KategoriArtikelResource extends Resource
{
    protected static ?string $model = KategoriArtikel::class;
    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $navigationLabel = 'Kategori Artikel';
    protected static ?int $navigationSort = 1;
    protected static ?string $pluralModelLabel = 'Daftar Kategori Artikel';
    protected static ?string $navigationGroup = 'Berita';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Kategori Artikel')
                    ->description('Kelola kategori untuk artikel dan berita sekolah')
                    ->icon('heroicon-o-tag')
                    ->schema([
                        Forms\Components\TextInput::make('nama_kategori')
                            ->label('Nama Kategori')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                fn ($state, callable $set) =>
                                $set('slug', Str::slug($state))
                            )
                            ->placeholder('Contoh: Prestasi Sekolah')
                            ->prefixIcon('heroicon-m-tag')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug URL')
                            ->disabled()
                            ->dehydrated()
                            ->prefixIcon('heroicon-m-link')
                            ->helperText('Slug dibuat otomatis dari nama kategori'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kategori')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-m-tag')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Slug berhasil disalin')
                    ->badge()
                    ->color('gray')
                    ->icon('heroicon-m-link')
                    ->limit(30),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since()
                    ->color('success'),

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

            ->emptyStateHeading('Belum ada kategori artikel')
            ->emptyStateDescription('Tambahkan kategori untuk artikel sekolah.')
            ->emptyStateIcon('heroicon-o-tag');
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
            'index' => Pages\ListKategoriArtikels::route('/'),
            'create' => Pages\CreateKategoriArtikel::route('/create'),
            'edit' => Pages\EditKategoriArtikel::route('/{record}/edit'),
        ];
    }
}
