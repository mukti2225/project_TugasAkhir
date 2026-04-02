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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Kesiswaan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Ekstrakulikuler')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\FileUpload::make('foto')
                    ->label('Foto')
                    ->image()
                    ->directory('ekstrakulikuler-fotos')
                    ->maxSize(1024)
                    ->acceptedFileTypes(['image/*'])
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Ekstrakulikuler')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
