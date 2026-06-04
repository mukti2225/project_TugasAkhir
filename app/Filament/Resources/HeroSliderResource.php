<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSliderResource\Pages;
use App\Models\HeroSlider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HeroSliderResource extends Resource
{
    protected static ?string $model = HeroSlider::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    protected static ?int $navigationSort = 1;
    
    protected static ?string $navigationLabel = 'Banner Sekolah';

    protected static ?string $pluralModelLabel = 'Daftar Banner';

    protected static ?string $navigationGroup = 'Home';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Banner')
                ->description('Kelola banner untuk halaman utama website sekolah')
                ->icon('heroicon-o-photo')
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Judul Banner')
                                ->placeholder('Contoh: Selamat Datang di SMA ARH')
                                ->maxLength(255)
                                ->columnSpanFull(),

                            Forms\Components\TextInput::make('subtitle')
                                ->label('Sub Judul')
                                ->placeholder('Sekolah unggul dan berprestasi')
                                ->maxLength(255)
                                ->columnSpanFull(),

                            Forms\Components\TextInput::make('kategori')
                                ->label('Kategori')
                                ->placeholder('PPDB 2026 / Prestasi / Informasi')
                                ->prefixIcon('heroicon-m-tag')
                                ->maxLength(255),

                            Forms\Components\TextInput::make('order')
                                ->label('Urutan Tampil')
                                ->numeric()
                                ->default(1)
                                ->minValue(1)
                                ->prefixIcon('heroicon-m-bars-arrow-down')
                        ]),

                    Forms\Components\FileUpload::make('image')
                        ->label('Gambar Banner')
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
                        ->imageEditor()
                        ->directory('hero-slider')
                        ->panelLayout('integrated')
                        ->removeUploadedFileButtonPosition('right')
                        ->uploadProgressIndicatorPosition('left')
                        ->openable()
                        ->downloadable()
                        ->columnSpanFull()
                        ->helperText('Upload gambar banner dengan rasio landscape agar hasil lebih optimal.'),
                ])
                ->columns(1),

            Forms\Components\Section::make('Tombol CTA')
                ->description('Pengaturan tombol aksi pada banner')
                ->icon('heroicon-o-cursor-arrow-rays')
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('button_text')
                                ->label('Teks Tombol')
                                ->placeholder('Lihat Selengkapnya')
                                ->prefixIcon('heroicon-m-cursor-arrow-ripple')
                                ->maxLength(255),

                            Forms\Components\TextInput::make('button_link')
                                ->label('Link Tombol')
                                ->placeholder('https://example.com')
                                ->url()
                                ->prefixIcon('heroicon-m-link')
                                ->maxLength(255),
                        ]),
                ]),

            Forms\Components\Section::make('Pengaturan Banner')
                ->description('Atur status banner')
                ->icon('heroicon-o-cog-6-tooth')
                ->schema([
                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktifkan Banner')
                        ->helperText('Banner akan tampil di halaman homepage')
                        ->default(true)
                        ->inline(false),
                ])
                ->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->square()
                    ->size(80)
                    ->defaultImageUrl(url('/images/no-image.png')),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(30)
                    ->description(fn ($record) => str($record->subtitle)
                    ->limit(40)),
                Tables\Columns\BadgeColumn::make('kategori')
                    ->label('Kategori')
                    ->sortable(),
                Tables\Columns\TextColumn::make('button_text')
                    ->label('Tombol')
                    ->badge()
                    ->color('gray')
                    ->placeholder('-'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->badge()
                    ->color('warning')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diupdate')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'PPDB' => 'PPDB',
                        'Prestasi' => 'Prestasi',
                        'Informasi' => 'Informasi',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Banner'),
            ])

            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('aktifkan')
                        ->label('Aktifkan Banner')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update([
                            'is_active' => true,
                        ])),
                    Tables\Actions\BulkAction::make('nonaktifkan')
                        ->label('Nonaktifkan Banner')
                        ->color('danger')
                        ->action(fn ($records) => $records->each->update([
                            'is_active' => false,
                        ])),
                ]),
            ])
            ->emptyStateHeading('Belum ada banner')
            ->emptyStateDescription('Tambahkan banner hero untuk homepage sekolah.')
            ->emptyStateIcon('heroicon-o-photo');
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroSliders::route('/'),
            'create' => Pages\CreateHeroSlider::route('/create'),
            'edit' => Pages\EditHeroSlider::route('/{record}/edit'),
        ];
    }
}
