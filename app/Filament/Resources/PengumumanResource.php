<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengumumanResource\Pages;
use App\Models\Pengumuman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengumumanResource extends Resource
{
    protected static ?string $model = Pengumuman::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    
    protected static ?string $navigationLabel = 'Pengumuman';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Berita';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengumuman')
                    ->description('Kelola pengumuman sekolah dan file PDF')
                    ->icon('heroicon-o-megaphone')
                    ->schema([

                        Forms\Components\Grid::make([
                            'default' => 1,
                            'lg' => 2,
                        ])
                            ->schema([
                                Forms\Components\TextInput::make('judul')
                                    ->label('Judul Pengumuman')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(
                                        fn ($state, callable $set) =>
                                        $set('slug', \Str::slug($state))
                                    )
                                    ->placeholder('Contoh: Jadwal Ujian Semester')
                                    ->prefixIcon('heroicon-m-megaphone')
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug URL')
                                    ->required()
                                    ->readOnly()
                                    ->unique(
                                        Pengumuman::class,
                                        'slug',
                                        ignoreRecord: true
                                    )
                                    ->prefixIcon('heroicon-m-link')
                                    ->helperText('Slug dibuat otomatis'),
                            ]),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi Pengumuman')
                            ->rows(5)
                            ->placeholder('Tuliskan isi pengumuman...')
                            ->autosize()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('file_pdf')
                            ->label('File PDF')
                            ->acceptedFileTypes([
                                'application/pdf',
                            ])
                            ->disk('public')
                            ->directory('pengumuman/pdf')
                            ->panelLayout('compact')
                            ->helperText('Upload file PDF pengumuman')
                            ->downloadable()
                            ->openable()
                            ->previewable(false)
                            ->maxSize(1024 * 5)
                            ->columnSpanFull(),

                        Forms\Components\Hidden::make('user_id')
                            ->default(auth()->id()),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Pengumuman')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->lineClamp(2)
                    ->description(fn ($record) =>
                        \Illuminate\Support\Str::limit(
                            $record->deskripsi,
                            70
                        )
                    ),

                Tables\Columns\IconColumn::make('file_pdf')
                    ->label('PDF')
                    ->boolean()
                    ->trueIcon('heroicon-o-document')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dipublish')
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

            ->emptyStateHeading('Belum ada pengumuman')
            ->emptyStateDescription('Tambahkan pengumuman sekolah.')
            ->emptyStateIcon('heroicon-o-megaphone');
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
            'index' => Pages\ListPengumumen::route('/'),
            'create' => Pages\CreatePengumuman::route('/create'),
            'edit' => Pages\EditPengumuman::route('/{record}/edit'),
        ];
    }
}
