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

    protected static ?string $navigationLabel = 'Lulus PTN';
    protected static ?string $pluralModelLabel = 'Daftar Lulus PTN';

    protected static ?string $navigationGroup = 'Profil';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('universitas')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->maxSize(1024*2),
                Forms\Components\FileUpload::make('logo')
                    ->image()
                    ->maxSize(1024*2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                tables\Columns\TextColumn::make('universitas')
                    ->searchable(),
                tables\Columns\ImageColumn::make('foto')
                    ->rounded(),
                tables\Columns\ImageColumn::make('logo')
                    ->rounded(),
                Tables\Columns\TextColumn::make('created_at')
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
            'index' => Pages\ListPtns::route('/'),
            'create' => Pages\CreatePtn::route('/create'),
            'edit' => Pages\EditPtn::route('/{record}/edit'),
        ];
    }
}
