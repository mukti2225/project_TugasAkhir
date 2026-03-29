<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormulirResource\Pages;
use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class FormulirResource extends Resource
{
    // Mengubah Model ke Pendaftaran agar datanya sinkron dengan frontend
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationLabel = 'Formulir Pendaftaran';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('KETERANGAN DATA DIRI SISWA')
                ->schema([
                    Hidden::make('user_id')->default(auth()->id()),
                    TextInput::make('nomor_pendaftaran')->label('Nomor Pendaftaran')
                        ->disabled()
                        ->dehydrated(false)
                        ->helperText('Otomatis dibuat dari Tanggal Lahir pendaftar.'),
                    TextInput::make('nama')->label('Nama Lengkap')->required()->maxLength(255),
                    TextInput::make('email')->label('Email Aktif')->email()->required()->maxLength(255),
                    TextInput::make('nik')->label('NIK')
                        ->rules(['digits:16'])
                        ->tel()
                        ->required()->unique(ignoreRecord: true),
                    TextInput::make('tempat_lahir')->label('Tempat Lahir')->required(),
                    DatePicker::make('tanggal_lahir')->label('Tanggal Lahir')->required(),
                    Radio::make('jenis_kelamin')->label('Jenis Kelamin')
                        ->options([
                            'Laki-laki' => 'Laki-laki',
                            'Perempuan' => 'Perempuan',
                        ])->required(),
                    Select::make('agama')->label('Agama')
                        ->options([
                            'Islam' => 'Islam',
                            'Kristen' => 'Kristen',
                            'Katolik' => 'Katolik',
                            'Hindu' => 'Hindu',
                            'Buddha' => 'Buddha',
                            'Konghucu' => 'Konghucu',
                        ])->required(),
                    TextInput::make('anak')->label('Anak Ke-')->numeric()->required(),
                    Select::make('status')->label('Status anak')
                        ->options([
                            'Kandung' => 'Kandung',
                            'Angkat' => 'Angkat',
                        ])->required(),
                ])->columns(2),

                Section::make('KETERANGAN TEMPAT TINGGAL SISWA')
                ->schema([
                    TextInput::make('nomor_telepon_siswa')->label('Nomor Telpon Siswa')->tel()->required(),
                    TextInput::make('nomor_telepon')->label('Nomor Telpon Rumah')->tel()->nullable(),
                    Select::make('tinggal')
                        ->options([
                            'Orang Tua' => 'Orang Tua',
                            'Saudara' => 'Saudara',
                            'Wali' => 'Wali',
                            'Kost' => 'Kost',
                        ])->label('Tinggal Dengan')->required(),
                    TextInput::make('jarak_sekolah')->label('Jarak ke Sekolah')->required(),
                    Textarea::make('alamat')->label('Alamat Lengkap')->required()->columnSpanFull(),
                ])->columns(2),

                Section::make('KETERANGAN PENDIDIKAN SEBELUMNYA')
                ->schema([
                    Select::make('pendidikan')->label('Pendidikan terakhir')
                        ->options([
                            'SD' => 'SD',
                            'MI' => 'MI',
                            'SMP' => 'SMP',
                            'MTS' => 'MTS',
                            'Paket A/B' => 'Paket A/B',
                        ])->required(),
                    TextInput::make('nisn')->unique(ignoreRecord: true)->label('NISN')->tel()->rules(['digits:10'])->required(),
                    TextInput::make('ijazah')->label('No Ijazah')->required(),
                    TextInput::make('asal_sekolah')->label('Asal Sekolah')->required(),
                    TextInput::make('pindahan')->label('Alasan Pindahan (Pindahan)')->nullable(),
                    Select::make('program_studi')->label('Program Studi Pilihan')
                        ->options([
                            'IPA' => 'IPA',
                            'IPS' => 'IPS',
                            'BAHASA' => 'BAHASA',
                        ])->required(),
                ])->columns(2),

                Section::make('KETERANGAN AYAH KANDUNG')
                ->schema([
                    TextInput::make('nama_ayah')->label('Nama Ayah')->required(),
                    TextInput::make('tempat_lahir_ayah')->label('Tempat lahir')->required(),
                    DatePicker::make('tanggal_lahir_ayah')->label('Tanggal Lahir')->required(),
                    Select::make('agama_ayah')->label('Agama')
                        ->options([
                            'Islam' => 'Islam',
                            'Kristen' => 'Kristen',
                            'Katolik' => 'Katolik',
                            'Hindu' => 'Hindu',
                            'Buddha' => 'Buddha',
                            'Konghucu' => 'Konghucu',
                        ])->required(),
                    Select::make('pendidikan_ayah')->label('Pendidikan Terakhir')
                        ->options([
                            'SD/Sederajat' => 'SD/Sederajat',
                            'SMP/Sederajat' => 'SMP/Sederajat',
                            'SMA/Sederajat' => 'SMA/Sederajat',
                            'D3' => 'D3',
                            'S1' => 'S1',
                            'S2' => 'S2',
                            'S3' => 'S3',
                        ])->required(),
                    TextInput::make('pekerjaan_ayah')->label('Pekerjaan')->required(),
                    TextInput::make('penghasilan_ayah')->label('Penghasilan')->numeric()->required(),
                    TextInput::make('nomor_telepon_ayah')->tel()->label('Nomor Telepon')->required(),
                    Textarea::make('alamat_ayah')->label('Alamat Lengkap')->required()->columnSpanFull(),
                ])->columns(2),

                Section::make('KETERANGAN IBU KANDUNG')
                ->schema([
                    TextInput::make('nama_ibu')->label('Nama Ibu')->required(),
                    TextInput::make('tempat_lahir_ibu')->label('Tempat lahir')->required(),
                    DatePicker::make('tanggal_lahir_ibu')->label('Tanggal Lahir')->required(),
                    Select::make('agama_ibu')->label('Agama')
                        ->options([
                            'Islam' => 'Islam',
                            'Kristen' => 'Kristen',
                            'Katolik' => 'Katolik',
                            'Hindu' => 'Hindu',
                            'Buddha' => 'Buddha',
                            'Konghucu' => 'Konghucu',
                        ])->required(),
                    Select::make('pendidikan_ibu')->label('Pendidikan Terakhir')
                        ->options([
                            'SD/Sederajat' => 'SD/Sederajat',
                            'SMP/Sederajat' => 'SMP/Sederajat',
                            'SMA/Sederajat' => 'SMA/Sederajat',
                            'D3' => 'D3',
                            'S1' => 'S1',
                            'S2' => 'S2',
                            'S3' => 'S3',
                        ])->required(),
                    TextInput::make('pekerjaan_ibu')->label('Pekerjaan')->required(),
                    TextInput::make('penghasilan_ibu')->label('Penghasilan')->numeric()->required(),
                    TextInput::make('nomor_telepon_ibu')->tel()->label('Nomor Telepon')->required(),
                    Textarea::make('alamat_ibu')->label('Alamat Lengkap')->required()->columnSpanFull(),
                ])->columns(2),

                Section::make('KETERANGAN WALI')
                ->schema([
                    TextInput::make('nama_wali')->label('Nama Wali')->nullable(),
                    TextInput::make('tempat_lahir_wali')->label('Tempat lahir')->nullable(),
                    DatePicker::make('tanggal_lahir_wali')->label('Tanggal Lahir')->nullable(),
                    Select::make('agama_wali')->label('Agama')
                        ->options([
                            'Islam' => 'Islam',
                            'Kristen' => 'Kristen',
                            'Katolik' => 'Katolik',
                            'Hindu' => 'Hindu',
                            'Buddha' => 'Buddha',
                            'Konghucu' => 'Konghucu',
                        ])->nullable(),
                    Select::make('pendidikan_wali')->label('Pendidikan Terakhir')
                        ->options([
                            'SD/Sederajat' => 'SD/Sederajat',
                            'SMP/Sederajat' => 'SMP/Sederajat',
                            'SMA/Sederajat' => 'SMA/Sederajat',
                            'D3' => 'D3',
                            'S1' => 'S1',
                            'S2' => 'S2',
                            'S3' => 'S3',
                        ])->nullable(),
                    TextInput::make('pekerjaan_wali')->label('Pekerjaan')->nullable(),
                    TextInput::make('penghasilan_wali')->label('Penghasilan')->numeric()->nullable(),
                    TextInput::make('nomor_telepon_wali')->tel()->label('Nomor Telepon')->nullable(),
                    Textarea::make('alamat_wali')->label('Alamat Lengkap')->nullable()->columnSpanFull(),
                    Select::make('status_penerimaan')->label('Status Penerimaan')
                            ->options([
                                'Menunggu' => 'Menunggu',
                                'Diterima' => 'Diterima',
                                'Ditolak' => 'Ditolak',
                            ])
                            ->default('Menunggu')
                            ->required()
                            ->visible(fn () => auth()->user()?->hasRole('admin') ?? false),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchable(auth()->user()?->hasRole('admin') ?? false)
            ->paginated(auth()->user()?->hasRole('admin') ?? false)
            ->columns([
                TextColumn::make('status_penerimaan')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Menunggu' => 'warning',
                        'Diterima' => 'success',
                        'Ditolak' => 'danger',
                        default => 'gray',
                    })
                    ->visible(fn () => auth()->user()?->hasRole('admin') ?? false),

                TextColumn::make('nomor_pendaftaran')
                    ->label('No. Pendaftaran')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(auth()->user()?->hasRole('admin') ?? false),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable(),

                TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin'),

                TextColumn::make('asal_sekolah')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->dateTime('d M Y')
                    ->sortable(auth()->user()?->hasRole('admin') ?? false),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('export_pdf')
                    ->label('Print PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function ($record) {
                        $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $record->nama ?? 'formulir');

                        return response()->streamDownload(function () use ($record) {
                            $pdf = Pdf::loadView('pdf.formulir', [
                                'data' => $record,
                            ])->setPaper('A4', 'portrait');
                            echo $pdf->output();
                        }, "Formulir_{$safeName}.pdf");
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                    ->visible(fn () => auth()->user()->hasRole('admin')),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (!auth()->user()->hasRole('admin')) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormulirs::route('/'),
            'create' => Pages\CreateFormulir::route('/create'),
            'edit' => Pages\EditFormulir::route('/{record}/edit'),
        ];
    }
}
