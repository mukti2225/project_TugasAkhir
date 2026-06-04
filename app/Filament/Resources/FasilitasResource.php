<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FasilitasResource\Pages;
use App\Filament\Resources\FasilitasResource\RelationManagers;
use App\Models\Fasilitas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FasilitasResource extends Resource
{
    protected static ?string $model = Fasilitas::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Profile';

    protected static ?string $navigationLabel = 'Fasilitas Sekolah';
    
    protected static ?int $navigationSort = 3;

    protected static ?string $pluralModelLabel = 'Daftar Fasilitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Fasilitas')
                    ->description('Kelola fasilitas yang tersedia di sekolah')
                    ->icon('heroicon-o-building-office-2')
                    ->schema([

                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Fasilitas')
                            ->required()
                            ->placeholder('Contoh: Laboratorium Komputer')
                            ->prefixIcon('heroicon-m-building-library')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('foto')
                            ->label('Foto Fasilitas')
                            ->image()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                                'image/heic',
                                'image/heif',
                            ])
                            ->required()
                            ->disk('public')
                            ->directory('fasilitas')
                            ->panelLayout('compact')
                            ->imageEditor()
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->maxSize(2048)
                            ->openable()
                            ->downloadable()
                            ->helperText('Upload foto fasilitas sekolah')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->square()
                    ->size(60)
                    ->defaultImageUrl(url('/images/no-image.png')),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Fasilitas')
                    ->weight('bold')
                    ->lineClamp(2)
                    ->description(fn ($record) =>
                        'Ditambahkan ' . $record->created_at->diffForHumans()
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
            ->emptyStateHeading('Belum ada fasilitas')
            ->emptyStateDescription('Tambahkan fasilitas sekolah.')
            ->emptyStateIcon('heroicon-o-building-office-2');
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
            'index' => Pages\ListFasilitas::route('/'),
            'create' => Pages\CreateFasilitas::route('/create'),
            'edit' => Pages\EditFasilitas::route('/{record}/edit'),
        ];
    }
}
