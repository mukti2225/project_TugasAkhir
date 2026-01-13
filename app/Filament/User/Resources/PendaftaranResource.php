<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Pendaftaran;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\PendaftaranResource\Pages;
use App\Filament\User\Resources\PendaftaranResource\RelationManagers;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 /* =====================
             | DATA SISWA
             ===================== */
            Forms\Components\Section::make('Data Siswa')
                ->schema([
                    Forms\Components\TextInput::make('nama_lengkap')
                        ->label('Nama Lengkap')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('nisn')
                        ->label('NISN')
                        ->required()
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('nik')
                        ->label('NIK')
                        ->numeric()
                        ->nullable(),

                    Forms\Components\TextInput::make('tempat_lahir')
                        ->label('Tempat Lahir')
                        ->required(),

                    Forms\Components\DatePicker::make('tanggal_lahir')
                        ->label('Tanggal Lahir')
                        ->required(),

                    Forms\Components\Select::make('jenis_kelamin')
                        ->label('Jenis Kelamin')
                        ->options([
                            'L' => 'Laki-laki',
                            'P' => 'Perempuan',
                        ])
                        ->required(),

                    Forms\Components\TextInput::make('agama')
                        ->label('Agama')
                        ->required(),
                ])
                ->columns(2),

            /* =====================
             | DATA SEKOLAH ASAL
             ===================== */
            Forms\Components\Section::make('Data Sekolah Asal')
                ->schema([
                    Forms\Components\TextInput::make('asal_sekolah')
                        ->label('Asal Sekolah')
                        ->required(),

                    Forms\Components\TextInput::make('alamat_sekolah')
                        ->label('Alamat Sekolah')
                        ->nullable(),
                ])
                ->columns(2),

            /* =====================
             | DATA ORANG TUA
             ===================== */
            Forms\Components\Section::make('Data Orang Tua')
                ->schema([
                    Forms\Components\TextInput::make('nama_ayah')
                        ->label('Nama Ayah')
                        ->required(),

                    Forms\Components\TextInput::make('nama_ibu')
                        ->label('Nama Ibu')
                        ->required(),

                    Forms\Components\TextInput::make('no_hp_orang_tua')
                        ->label('No. HP Orang Tua')
                        ->tel()
                        ->required(),
                ])
                ->columns(2),

            /* =====================
             | ALAMAT SISWA
             ===================== */
            Forms\Components\Section::make('Alamat Siswa')
                ->schema([
                    Forms\Components\Textarea::make('alamat')
                        ->label('Alamat Lengkap')
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('desa')
                        ->label('Desa')
                        ->nullable(),

                    Forms\Components\TextInput::make('kecamatan')
                        ->label('Kecamatan')
                        ->nullable(),

                    Forms\Components\TextInput::make('kabupaten')
                        ->label('Kabupaten')
                        ->nullable(),

                    Forms\Components\TextInput::make('provinsi')
                        ->label('Provinsi')
                        ->nullable(),
                ])
                ->columns(2),

            /* =====================
             | STATUS (ADMIN ONLY)
             ===================== */
            Forms\Components\Select::make('status')
                ->label('Status Pendaftaran')
                ->options([
                    'pending' => 'Pending',
                    'diverifikasi' => 'Diverifikasi',
                    'diterima' => 'Diterima',
                    'ditolak' => 'Ditolak',
                ])
                ->default('pending')
                ->visible(fn () => auth()->user()?->hasRole('admin')),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap'),
                Tables\Columns\TextColumn::make('nisn'),
                Tables\Columns\TextColumn::make('asal_sekolah'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->date('d M Y'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'Pending',
                        'info' => 'Diverifikasi',
                        'success' => 'Diterima',
                        'danger' => 'Ditolak',
                    ]),
            ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());
    }

    public static function canCreate(): bool
    {
        return ! static::getModel()
            ::where('user_id', auth()->id())
            ->exists();
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
            'index' => Pages\ListPendaftarans::route('/'),
            'create' => Pages\CreatePendaftaran::route('/create'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}
