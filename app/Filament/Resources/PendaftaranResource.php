<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Pendaftaran;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PendaftaranResource\Pages;
use App\Filament\Resources\PendaftaranResource\RelationManagers;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            /* =====================
             | DATA AKUN USER
             ===================== */
                Forms\Components\Section::make('Akun Pendaftar')
                ->schema([
                    Forms\Components\Select::make('user_id')
                        ->label('User')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->required(),
                ]),

            /* =====================
             | DATA SISWA
             ===================== */
            Forms\Components\Section::make('Data Siswa')
                ->schema([
                    Forms\Components\TextInput::make('nama_lengkap')
                        ->required(),

                    Forms\Components\TextInput::make('nisn')
                        ->required()
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('nik')
                        ->nullable(),

                    Forms\Components\TextInput::make('tempat_lahir')
                        ->required(),

                    Forms\Components\DatePicker::make('tanggal_lahir')
                        ->required(),

                    Forms\Components\Select::make('jenis_kelamin')
                        ->options([
                            'L' => 'Laki-laki',
                            'P' => 'Perempuan',
                        ])
                        ->required(),

                    Forms\Components\TextInput::make('agama')
                        ->required(),
                ])
                ->columns(2),

            /* =====================
             | DATA SEKOLAH ASAL
             ===================== */
            Forms\Components\Section::make('Data Sekolah Asal')
                ->schema([
                    Forms\Components\TextInput::make('asal_sekolah')
                        ->required(),

                    Forms\Components\TextInput::make('alamat_sekolah')
                        ->nullable(),
                ])
                ->columns(2),

            /* =====================
             | DATA ORANG TUA
             ===================== */
            Forms\Components\Section::make('Data Orang Tua')
                ->schema([
                    Forms\Components\TextInput::make('nama_ayah')
                        ->required(),

                    Forms\Components\TextInput::make('nama_ibu')
                        ->required(),

                    Forms\Components\TextInput::make('no_hp_orang_tua')
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
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('desa')->nullable(),
                    Forms\Components\TextInput::make('kecamatan')->nullable(),
                    Forms\Components\TextInput::make('kabupaten')->nullable(),
                    Forms\Components\TextInput::make('provinsi')->nullable(),
                ])
                ->columns(2),

            /* =====================
             | STATUS PENDAFTARAN
             ===================== */
            Forms\Components\Section::make('Status Pendaftaran')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'diverifikasi' => 'Diverifikasi',
                            'diterima' => 'Diterima',
                            'ditolak' => 'Ditolak',
                        ])
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            /* =====================
            | USER
             ===================== */
            Tables\Columns\TextColumn::make('user.name')
                ->label('User')
                ->searchable()
                ->sortable(),
            /* =====================
             | DATA SISWA
             ===================== */
            Tables\Columns\TextColumn::make('nama_lengkap')
                ->label('Nama Lengkap')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('nisn')
                ->label('NISN')
                ->searchable(),

            Tables\Columns\TextColumn::make('asal_sekolah')
                ->label('Asal Sekolah')
                ->searchable(),

            /* =====================
             | STATUS
             ===================== */
            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'warning' => 'Pending',
                    'info' => 'Diverifikasi',
                    'success' => 'Diterima',
                    'danger' => 'Ditolak',
                ])
                ->sortable(),

            /* =====================
             | WAKTU
             ===================== */
            Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal Daftar')
                ->date('d M Y')
                ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'diverifikasi' => 'Diverifikasi',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    protected static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] ??= Auth::id();
        return $data;
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
