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

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Kepala Sekolah';

    protected static ?string $pluralModelLabel = 'Sambutan & Statistik Sekolah';

    protected static ?string $navigationGroup = 'Home';
    

    public static function form(Form $form): Form
    {
        return $form
                    ->schema([

            Forms\Components\Section::make('Informasi Sambutan')
                ->description('Kelola data sambutan kepala sekolah')
                ->icon('heroicon-o-megaphone')
                ->schema([
                    Forms\Components\Grid::make([
                        'default' => 1,
                        'md' => 2,
                    ])
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Judul Sambutan')
                                ->required()
                                ->placeholder('Selamat Datang di SMA...')
                                ->maxLength(255)
                                ->columnSpanFull(),

                            Forms\Components\TextInput::make('name')
                                ->label('Nama Kepala Sekolah')
                                ->required()
                                ->placeholder('Drs. Ahmad Rizki')
                                ->prefixIcon('heroicon-m-user')
                                ->maxLength(255),

                            Forms\Components\TextInput::make('position')
                                ->label('Jabatan')
                                ->required()
                                ->default('Kepala Sekolah')
                                ->prefixIcon('heroicon-m-identification')
                                ->maxLength(255),

                        ]),

                    Forms\Components\FileUpload::make('photo')
                        ->label('Foto Kepala Sekolah')
                        ->image()
                        ->required()
                        ->directory('kepala-sekolah')
                        ->imageEditor()
                        ->imagePreviewHeight('120')
                        ->panelAspectRatio('2:3')
                        ->panelLayout('integrated')
                        ->downloadable()
                        ->openable()
                        ->helperText('Upload foto formal kepala sekolah')
                        ->columnSpan([
                            'default' => 1,
                            'md' => 1,
                        ]),

                    Forms\Components\RichEditor::make('sambutan')
                        ->label('Isi Sambutan')
                        ->required()
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'underline',
                            'bulletList',
                            'orderedList',
                            'h2',
                            'h3',
                            'blockquote',
                            'redo',
                            'undo',
                        ])
                        ->placeholder('Tuliskan kalimat sambutan kepala sekolah...')
                        ->columnSpanFull(),

                ]),

            Forms\Components\Section::make('Statistik Sekolah')
                ->description('Data statistik utama sekolah')
                ->icon('heroicon-o-chart-bar')
                ->schema([

                    Forms\Components\Grid::make([
                        'default' => 1,
                        'sm' => 2,
                        'xl' => 3,
                    ])
                        ->schema([

                            Forms\Components\TextInput::make('total_teachers')
                                ->label('Total Guru')
                                ->numeric()
                                ->required()
                                ->default(0)
                                ->prefixIcon('heroicon-m-academic-cap')
                                ->suffix('Guru'),

                            Forms\Components\TextInput::make('total_students')
                                ->label('Total Murid')
                                ->numeric()
                                ->required()
                                ->default(0)
                                ->prefixIcon('heroicon-m-user-group')
                                ->suffix('Siswa'),

                            Forms\Components\TextInput::make('total_classes')
                                ->label('Total Kelas')
                                ->numeric()
                                ->required()
                                ->default(0)
                                ->prefixIcon('heroicon-m-building-office-2')
                                ->suffix('Kelas'),

                        ]),

                ])
                ->collapsible(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchable(false)
            ->paginated(false)
            ->columns([

                Tables\Columns\ImageColumn::make('photo')
                    ->label('')
                    ->circular()
                    ->size(60),

                Tables\Columns\TextColumn::make('name')
                    ->label('Kepala Sekolah')
                    ->weight('bold')
                    ->searchable()
                    ->description(fn ($record) => $record->position),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Sambutan')
                    ->limit(40)
                    ->lineClamp(2)
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_teachers')
                    ->label('Guru')
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-m-academic-cap'),

                Tables\Columns\TextColumn::make('total_students')
                    ->label('Murid')
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-m-user-group'),

                Tables\Columns\TextColumn::make('total_classes')
                    ->label('Kelas')
                    ->badge()
                    ->color('warning')
                    ->icon('heroicon-m-building-office-2'),

            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton(),
            ])
            ->emptyStateHeading('Belum ada data sambutan')
            ->emptyStateDescription('Tambahkan sambutan kepala sekolah.')
            ->emptyStateIcon('heroicon-o-megaphone')
        ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return Statistik::count() === 0;
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
