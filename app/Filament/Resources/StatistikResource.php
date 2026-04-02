<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatistikResource\Pages;
use App\Filament\Resources\StatistikResource\RelationManagers;
use App\Models\Statistik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StatistikResource extends Resource
{
    protected static ?string $model = Statistik::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Sambutan Sekolah';

    protected static ?string $pluralModelLabel = 'Sambutan Sekolah';

    protected static ?string $navigationGroup = 'Home';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255)
                    ->default('Selamat Datang di SMA Arif Rahman Hakim'),
                Forms\Components\TextInput::make('name')
                    ->label('Nama Kepala Sekolah')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('photo')
                    ->label('Foto Kepala Sekolah')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('position')
                    ->label('Jabatan')
                    ->required()
                    ->maxLength(255)
                    ->default('Kepala Sekolah'),
                Forms\Components\RichEditor::make('sambutan')
                    ->label('Kalimat Sambutan')
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\TextInput::make('total_teachers')
                    ->label('Total Pengajar')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('total_students')
                    ->label('Total Murid')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('total_classes')
                    ->label('Total Rombongan belajar')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchable(false)
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Kepala Sekolah')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto'),
                Tables\Columns\TextColumn::make('total_teachers')
                    ->label('Total Guru')
                    ->numeric(),
                Tables\Columns\TextColumn::make('total_students')
                    ->label('Total Murid')
                    ->numeric(),
                Tables\Columns\TextColumn::make('total_classes')
                    ->label('Total Kelas')
                    ->numeric(),
            ])

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListStatistiks::route('/'),
            'create' => Pages\CreateStatistik::route('/create'),
            'edit' => Pages\EditStatistik::route('/{record}/edit'),
        ];
    }
}
