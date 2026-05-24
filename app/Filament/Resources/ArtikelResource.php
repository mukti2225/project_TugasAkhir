<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtikelResource\Pages;
use App\Filament\Resources\ArtikelResource\RelationManagers;
use App\Models\Artikel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\RichEditor;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArtikelResource extends Resource
{
    protected static ?string $model = Artikel::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
     protected static ?string $navigationLabel = 'Artikel';
    protected static ?int $navigationSort = 2;
    protected static ?string $pluralModelLabel = 'Daftar Artikel';

    protected static ?string $navigationGroup = 'Berita';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Artikel')
                    ->description('Kelola berita dan artikel sekolah')
                    ->icon('heroicon-o-newspaper')
                    ->schema([
                        Forms\Components\Grid::make([
                            'default' => 1,
                            'lg' => 2,
                        ])
                            ->schema([
                                Forms\Components\TextInput::make('judul')
                                    ->label('Judul Artikel')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(
                                        fn(string $state, Forms\Set $set) =>
                                        $set('slug', Str::slug($state))
                                    )
                                    ->placeholder('Contoh: Kegiatan MPLS Tahun 2026')
                                    ->prefixIcon('heroicon-m-pencil-square')
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug URL')
                                    ->disabled()
                                    ->dehydrated()
                                    ->prefixIcon('heroicon-m-link')
                                    ->helperText('Slug dibuat otomatis dari judul'),

                                Forms\Components\Select::make('kategori_artikel_id')
                                    ->label('Kategori Artikel')
                                    ->relationship('kategoriArtikel', 'nama_kategori')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->prefixIcon('heroicon-m-tag'),
                            ]),

                        Forms\Components\FileUpload::make('thumbnail')
                            ->label('Thumbnail Artikel')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->directory('artikel')
                            ->panelLayout('compact')
                            ->removeUploadedFileButtonPosition('right')
                            ->uploadButtonPosition('left')
                            ->openable()
                            ->downloadable()
                            ->helperText('Upload thumbnail artikel')
                            ->columnSpanFull(),

                        Forms\Components\Hidden::make('user_id')
                            ->default(fn() => auth()->id()),
                    ]),

                Forms\Components\Section::make('Isi Artikel')
                    ->description('Tulis isi lengkap artikel')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Forms\Components\RichEditor::make('deskripsi')
                            ->label('Konten Artikel')
                            ->required()
                            ->disableToolbarButtons([
                                'attachFiles',
                            ])
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
                            ->placeholder('Tuliskan isi artikel...')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                        Tables\Columns\ImageColumn::make('thumbnail')
                            ->label('Foto')
                            ->disk('public')
                            ->square()
                            ->size(60),

                        Tables\Columns\TextColumn::make('judul')
                            ->label('Artikel')
                            ->searchable()
                            ->sortable()
                            ->weight('bold')
                            ->lineClamp(2)
                            ->description(fn ($record) =>Str::limit(strip_tags($record->deskripsi),40)
                            ),

                        Tables\Columns\TextColumn::make('kategoriArtikel.nama_kategori')
                            ->label('Kategori')
                            ->badge()
                            ->color('info')
                            ->sortable(),

                        Tables\Columns\TextColumn::make('created_at')
                            ->label('Dipublish')
                            ->since()
                            ->color('success'),
                    ])
                    ->defaultSort('created_at', 'desc')
                    ->filters([
                        Tables\Filters\SelectFilter::make('kategori_artikel_id')
                            ->relationship('kategoriArtikel', 'nama_kategori')
                            ->label('Kategori'),
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

                    ->emptyStateHeading('Belum ada artikel')
                    ->emptyStateDescription('Tambahkan berita atau artikel sekolah.')
                    ->emptyStateIcon('heroicon-o-newspaper');
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
            'index' => Pages\ListArtikels::route('/'),
            'create' => Pages\CreateArtikel::route('/create'),
            'edit' => Pages\EditArtikel::route('/{record}/edit'),
        ];
    }
}
