<?php

namespace App\Filament\Resources;

use App\Models\Ptn;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PtnResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PtnResource\RelationManagers;

class PtnResource extends Resource
{
    protected static ?string $model = Ptn::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Kelulusan Siswa';

    protected static ?string $pluralModelLabel = 'Daftar Kelulusan Siswa';

    protected static ?string $navigationGroup = 'Home';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Alumni PTN')
                    ->description('Kelola data siswa yang lolos Perguruan Tinggi Negeri')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Forms\Components\Grid::make([
                            'default' => 1,
                            'md' => 2,
                        ])
                            ->schema([
                                Forms\Components\TextInput::make('nama')
                                    ->label('Nama Siswa')
                                    ->required()
                                    ->placeholder('Contoh: Ahmad Rizki')
                                    ->prefixIcon('heroicon-m-user')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('universitas')
                                    ->label('Universitas')
                                    ->required()
                                    ->placeholder('Universitas Indonesia')
                                    ->prefixIcon('heroicon-m-building-library')
                                    ->maxLength(255),
                            ]),

                        Forms\Components\Grid::make([
                            'default' => 1,
                            'md' => 2,
                        ])
                            ->schema([
                                Forms\Components\FileUpload::make('foto')
                                    ->label('Foto Siswa')
                                    ->image()
                                    ->acceptedFileTypes([
                                        'image/jpeg',
                                        'image/png',
                                        'image/webp',
                                        'image/heic',
                                        'image/heif',
                                    ])
                                    ->disk('public')
                                    ->directory('ptn/siswa')
                                    ->panelLayout('compact')
                                    ->imageEditor()
                                    ->maxSize(2048)
                                    ->helperText('Upload foto siswa')
                                    ->openable()
                                    ->downloadable(),

                                Forms\Components\FileUpload::make('logo')
                                    ->label('Logo Universitas')
                                    ->image()
                                    ->disk('public')
                                    ->directory('ptn/logo')
                                    ->panelLayout('compact')
                                    ->maxSize(2048)
                                    ->helperText('Upload logo universitas')
                                    ->openable()
                                    ->downloadable(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular()
                    ->size(50),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->universitas),

                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->square()
                    ->size(45),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->since()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])

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

            ->emptyStateHeading('Belum ada data alumni PTN')
            ->emptyStateDescription('Tambahkan siswa yang lolos perguruan tinggi negeri.')
            ->emptyStateIcon('heroicon-o-academic-cap');
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
            'index' => Pages\ListPtns::route('/'),
            'create' => Pages\CreatePtn::route('/create'),
            'edit' => Pages\EditPtn::route('/{record}/edit'),
        ];
    }
}
