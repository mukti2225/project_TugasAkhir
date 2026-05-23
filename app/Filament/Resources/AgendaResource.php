<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendaResource\Pages;
use App\Filament\Resources\AgendaResource\RelationManagers;
use App\Models\Agenda;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Home';
    protected static ?string $navigationLabel = 'Agenda Sekolah';
    protected static ?int $navigationSort = 3;

    protected static ?string $pluralModelLabel = 'Agenda Kegiatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Agenda')
                    ->description('Kelola agenda dan kegiatan sekolah')
                    ->icon('heroicon-o-calendar-days')
                    ->schema([

                        Forms\Components\Grid::make(2)
                            ->schema([

                                Forms\Components\TextInput::make('judul')
                                    ->label('Judul Agenda')
                                    ->placeholder('Contoh: Upacara Hari Senin')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Forms\Components\DatePicker::make('tanggal')
                                    ->label('Tanggal Agenda')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d F Y')
                                    ->closeOnDateSelection(),

                                Forms\Components\Select::make('kategori')
                                    ->label('Kategori')
                                    ->options([
                                        'upacara' => 'Upacara',
                                        'akademik' => 'Akademik',
                                        'olahraga' => 'Olahraga',
                                        'kegiatan' => 'Kegiatan',
                                        'libur' => 'Libur',
                                    ])
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->native(false),

                                Forms\Components\TextInput::make('jam')
                                    ->label('Waktu')
                                    ->placeholder('07.00 - 08.00')
                                    ->prefixIcon('heroicon-m-clock')
                                    ->maxLength(100),

                                Forms\Components\TextInput::make('lokasi')
                                    ->label('Lokasi')
                                    ->placeholder('Lapangan Utama')
                                    ->prefixIcon('heroicon-m-map-pin')
                                    ->maxLength(255),

                            ]),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi Kegiatan')
                            ->placeholder('Tuliskan detail agenda atau kegiatan...')
                            ->rows(5)
                            ->columnSpanFull(),

                        Forms\Components\Fieldset::make('Pengaturan')
                            ->schema([

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Aktifkan Agenda')
                                    ->helperText('Agenda akan tampil di website')
                                    ->default(true)
                                    ->inline(false),

                            ])
                            ->columns(2),

                    ])
                    ->columns(1)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Nama agenda')
                    ->searchable()
                    ->weight(FontWeight::SemiBold),

                Tables\Columns\BadgeColumn::make('kategori')
                    ->colors([
                        'primary' => 'upacara',
                        'info' => 'akademik',
                        'success' => 'olahraga',
                        'warning' => 'kegiatan',
                        'danger' => 'libur',
                    ]),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
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
                    Tables\Actions\BulkAction::make('aktifkan')
                        ->label('Aktifkan Agenda')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update([
                            'is_active' => true,
                        ])),
                    Tables\Actions\BulkAction::make('nonaktifkan')
                        ->label('Nonaktifkan Agenda')
                        ->color('danger')
                        ->action(fn ($records) => $records->each->update([
                            'is_active' => false,
                        ])),
                ]),
            ])
            ->emptyStateHeading('Belum ada Agenda')
            ->emptyStateDescription('Tambahkan Agenda untuk homepage sekolah.')
            ->emptyStateIcon('heroicon-o-calendar');
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
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }
}
