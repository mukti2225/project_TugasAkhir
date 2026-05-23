<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Galeri Kegiatan';
    protected static ?string $pluralModelLabel = 'Daftar Galeri Sekolah';

    protected static ?string $navigationGroup = 'Profile';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Galeri')
                ->description('Upload foto kegiatan dan dokumentasi sekolah')
                ->icon('heroicon-o-photo')
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label('Foto Galeri')
                        ->image()
                        ->required()
                        ->directory('gallery')
                        ->imageEditor()
                        ->panelLayout('compact')
                        ->removeUploadedFileButtonPosition('right')
                        ->uploadButtonPosition('left')
                        ->openable()
                        ->downloadable()
                        ->helperText('Upload foto dokumentasi sekolah')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('title')
                        ->label('Judul Foto')
                        ->placeholder('Contoh: Kegiatan Class Meeting')
                        ->prefixIcon('heroicon-m-photo')
                        ->maxLength(255)
                        ->columnSpanFull(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->square()
                    ->size(90)
                    ->defaultImageUrl(url('/images/no-image.png')),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->weight('bold')
                    ->lineClamp(2)
                    ->placeholder('Tanpa Judul')
                    ->description(fn ($record) =>
                        'Upload ' . $record->created_at->diffForHumans()
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
            ->emptyStateHeading('Belum ada foto galeri')
            ->emptyStateDescription('Tambahkan dokumentasi kegiatan sekolah.')
            ->emptyStateIcon('heroicon-o-photo');
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
