<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuruResource\Pages;
use App\Filament\Resources\GuruResource\RelationManagers;
use App\Models\Guru;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Profile';

    protected static ?string $navigationLabel = 'Guru & Tenaga Pendidik';
    protected static ?int $navigationSort = 4;

    protected static ?string $pluralModelLabel = 'Daftar Guru';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Guru')
                    ->description('Kelola data guru dan tenaga pendidik')
                    ->icon('heroicon-o-user-group')
                    ->schema([
                        Forms\Components\Grid::make([
                            'default' => 1,
                            'md' => 2,
                        ])
                            ->schema([
                                Forms\Components\TextInput::make('nama')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->placeholder('Contoh: Ahmad Rizki, S.Pd')
                                    ->prefixIcon('heroicon-m-user')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('nip')
                                    ->label('NIP')
                                    ->placeholder('198712122020011001')
                                    ->prefixIcon('heroicon-m-identification')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('jabatan')
                                    ->label('Jabatan')
                                    ->placeholder('Guru Matematika')
                                    ->prefixIcon('heroicon-m-briefcase')
                                    ->maxLength(255),

                                Forms\Components\Select::make('status')
                                    ->label('Status')
                                    ->prefixIcon('heroicon-m-check-badge')
                                    ->options([
                                        'PNS' => 'PNS',
                                        'Honorer' => 'Honorer',
                                    ]),

                                Forms\Components\TextInput::make('mata_pelajaran')
                                    ->label('Mata Pelajaran')
                                    ->placeholder('Matematika')
                                    ->prefixIcon('heroicon-m-book-open')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('pendidikan')
                                    ->label('Pendidikan Terakhir')
                                    ->placeholder('S1 Pendidikan Matematika')
                                    ->prefixIcon('heroicon-m-academic-cap')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('telepon')
                                    ->label('Nomor Telepon')
                                    ->tel()
                                    ->placeholder('08123456789')
                                    ->prefixIcon('heroicon-m-phone')
                                    ->maxLength(255),
                            ]),

                        Forms\Components\FileUpload::make('foto')
                            ->label('Foto Guru')
                            ->image()
                            ->required()
                            ->directory('guru')
                            ->imageEditor()
                            ->imagePreviewHeight('120')
                            ->panelLayout('compact')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->openable()
                            ->downloadable()
                            ->helperText('Upload foto formal guru')
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
                    ->circular()
                    ->size(60),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Guru')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->lineClamp(1)
                    ->description(fn ($record) =>
                        $record->jabatan ?: 'Tenaga Pendidik'
                    ),

                Tables\Columns\TextColumn::make('mata_pelajaran')
                    ->label('Mapel')
                    ->badge()
                    ->color('info')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) =>
                        str($state)->lower()->contains('pns')
                            ? 'success'
                            : 'warning'
                    )
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('pendidikan')
                    ->label('Pendidikan')
                    ->lineClamp(1)
                    ->color('gray')
                    ->placeholder('-'),

            ])
            ->defaultSort('nama')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'PNS' => 'PNS',
                        'Honorer' => 'Honorer',
                    ]),
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
            ->emptyStateHeading('Belum ada data guru')
            ->emptyStateDescription('Tambahkan guru dan tenaga pendidik.')
            ->emptyStateIcon('heroicon-o-user-group');
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
            'index' => Pages\ListGurus::route('/'),
            'create' => Pages\CreateGuru::route('/create'),
            'edit' => Pages\EditGuru::route('/{record}/edit'),
        ];
    }
}
