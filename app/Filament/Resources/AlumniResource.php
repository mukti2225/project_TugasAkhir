<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlumniResource\Pages;
use App\Filament\Resources\AlumniResource\RelationManagers;
use App\Models\Alumni;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlumniResource extends Resource
{
    protected static ?string $model = Alumni::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Kesiswaan';
    protected static ?string $navigationLabel = 'Alumni';
    protected static ?string $pluralModelLabel = 'Data Alumni';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Alumni')
                    ->description('Kelola daftar perguruan tinggi tujuan alumni')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Forms\Components\TextInput::make('caption')
                            ->label('Nama Perguruan Tinggi')
                            ->required()
                            ->placeholder('Contoh: Universitas Indonesia')
                            ->prefixIcon('heroicon-m-building-library')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo Perguruan Tinggi')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->directory('alumni-logo')
                            ->acceptedFileTypes([
                                'image/*',
                            ])
                            ->panelLayout('compact')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->maxSize(2048)
                            ->openable()
                            ->downloadable()
                            ->helperText('Upload logo universitas/perguruan tinggi (png)')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->contentGrid([
                'md' => 2,
                'xl' => 4,
            ])

            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->square()
                    ->size(80)
                    ->defaultImageUrl(url('/images/no-image.png')),

                Tables\Columns\TextColumn::make('caption')
                    ->label('Perguruan Tinggi')
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
            ->emptyStateHeading('Belum ada data alumni')
            ->emptyStateDescription('Tambahkan perguruan tinggi tujuan alumni.')
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
            'index' => Pages\ListAlumnis::route('/'),
            'create' => Pages\CreateAlumni::route('/create'),
            'edit' => Pages\EditAlumni::route('/{record}/edit'),
        ];
    }
}
