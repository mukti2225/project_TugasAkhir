<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormulirResource\Pages;
use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Jobs\ValidateBerkasJob;

class FormulirResource extends Resource
{

    protected static ?string $model = Pendaftaran::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'SPMB Online';

    protected static ?string $pluralModelLabel = 'Pendaftaran SPMB Online';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
                ->schema([
                Section::make('Data Diri Siswa')
                    ->description('Isi data siswa dengan lengkap dan benar.')
                    ->icon('heroicon-o-user')
                    ->collapsible()
                    ->persistCollapsed()
                    ->schema([
                        Hidden::make('user_id')
                            ->default(auth()->id()),
                        Hidden::make('ijazah_file_name'),
                        Hidden::make('kk_file_name'),
                        Hidden::make('akta_file_name'),

                        TextInput::make('nomor_pendaftaran')
                            ->label('Nomor Pendaftaran')
                            ->disabled()
                            ->dehydrated(false)
                            ->prefixIcon('heroicon-m-hashtag')
                            ->helperText('Nomor otomatis dibuat sistem.'),

                        TextInput::make('nama')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan nama lengkap')
                            ->prefixIcon('heroicon-m-user'),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->placeholder('contoh@gmail.com')
                            ->prefixIcon('heroicon-m-envelope'),

                        TextInput::make('nik')
                            ->label('NIK')
                            ->numeric()
                            ->required()
                            ->rules(['digits:16'])
                            ->unique(ignoreRecord: true)
                            ->placeholder('16 digit NIK')
                            ->prefixIcon('heroicon-m-identification')
                            ->helperText('Isi sesuai KTP / KK'),

                        TextInput::make('nisn')
                            ->label('NISN')
                            ->numeric()
                            ->required()
                            ->rules(['digits:10'])
                            ->unique(ignoreRecord: true)
                            ->placeholder('10 digit NISN')
                            ->prefixIcon('heroicon-m-identification'),

                        TextInput::make('tempat_lahir')
                            ->required()
                            ->prefixIcon('heroicon-m-map-pin'),

                        DatePicker::make('tanggal_lahir')
                            ->required(),

                        Radio::make('jenis_kelamin')
                            ->inline()
                            ->required()
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ]),

                        Select::make('agama')
                            ->required()
                            ->searchable()
                            ->options([
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Katolik' => 'Katolik',
                                'Hindu' => 'Hindu',
                                'Buddha' => 'Buddha',
                                'Konghucu' => 'Konghucu',
                            ]),

                        TextInput::make('anak')
                            ->label('Anak Ke')
                            ->numeric()
                            ->required(),

                        Select::make('status')
                            ->label('Status Anak')
                            ->required()
                            ->options([
                                'Kandung' => 'Kandung',
                                'Angkat' => 'Angkat',
                            ]),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ]),

                /*
                |--------------------------------------------------------------------------
                | TEMPAT TINGGAL
                |--------------------------------------------------------------------------
                */

                Section::make('Tempat Tinggal')
                    ->description('Informasi alamat dan tempat tinggal siswa.')
                    ->icon('heroicon-o-home')
                    ->collapsible()
                    ->schema([
                        TextInput::make('nomor_telepon_siswa')
                            ->tel()
                            ->required()
                            ->prefixIcon('heroicon-m-phone'),

                        TextInput::make('nomor_telepon')
                            ->tel()
                            ->prefixIcon('heroicon-m-device-phone-mobile'),

                        Select::make('tinggal')
                            ->label('Tinggal Dengan')
                            ->required()
                            ->options([
                                'Orang Tua' => 'Orang Tua',
                                'Saudara' => 'Saudara',
                                'Wali' => 'Wali',
                                'Kost' => 'Kost',
                            ]),

                        TextInput::make('jarak_sekolah')
                            ->label('Jarak ke Sekolah')
                            ->required()
                            ->suffix('KM'),

                        Textarea::make('alamat')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ]),

                /*
                |--------------------------------------------------------------------------
                | PENDIDIKAN
                |--------------------------------------------------------------------------
                */

                Section::make('Pendidikan Sebelumnya')
                    ->description('Data sekolah sebelumnya.')
                    ->icon('heroicon-o-academic-cap')
                    ->collapsible()
                    ->schema([
                        Select::make('pendidikan')
                            ->label('Pendidikan Terakhir')
                            ->required()
                            ->options([
                                'SD' => 'SD',
                                'MI' => 'MI',
                                'SMP' => 'SMP',
                                'MTS' => 'MTS',
                                'Paket A/B' => 'Paket A/B',
                            ]),

                        TextInput::make('ijazah')
                            ->label('Nomor Ijazah')
                            ->required(),

                        TextInput::make('asal_sekolah')
                            ->required(),

                        TextInput::make('pindahan')
                            ->label('Alasan Pindahan')
                            ->nullable(),

                        Select::make('program_studi')
                            ->required()
                            ->options([
                                'IPA' => 'IPA',
                                'IPS' => 'IPS',
                                'BAHASA' => 'BAHASA',
                            ]),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ]),

                /*
                |--------------------------------------------------------------------------
                | AYAH
                |--------------------------------------------------------------------------
                */

                Section::make('Data Ayah')
                    ->icon('heroicon-o-user')
                    ->collapsible()
                    ->schema([
                        TextInput::make('nama_ayah')->required(),
                        TextInput::make('tempat_lahir_ayah')->required(),
                        DatePicker::make('tanggal_lahir_ayah')->required(),
                        Select::make('agama_ayah')
                            ->required()
                            ->options([
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Katolik' => 'Katolik',
                                'Hindu' => 'Hindu',
                                'Buddha' => 'Buddha',
                                'Konghucu' => 'Konghucu',
                            ]),

                        Select::make('pendidikan_ayah')
                            ->required()
                            ->options([
                                'SD/Sederajat' => 'SD/Sederajat',
                                'SMP/Sederajat' => 'SMP/Sederajat',
                                'SMA/Sederajat' => 'SMA/Sederajat',
                                'D3' => 'D3',
                                'S1' => 'S1',
                                'S2' => 'S2',
                                'S3' => 'S3',
                            ]),

                        TextInput::make('pekerjaan_ayah')->required(),

                        TextInput::make('penghasilan_ayah')
                            ->numeric()
                            ->prefix('Rp'),

                        TextInput::make('nomor_telepon_ayah')
                            ->tel(),

                        Textarea::make('alamat_ayah')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ]),

                /*
                |--------------------------------------------------------------------------
                | IBU
                |--------------------------------------------------------------------------
                */

                Section::make('Data Ibu')
                    ->icon('heroicon-o-user')
                    ->collapsible()
                    ->schema([
                        TextInput::make('nama_ibu')->required(),
                        TextInput::make('tempat_lahir_ibu')->required(),
                        DatePicker::make('tanggal_lahir_ibu')->required(),
                        Select::make('agama_ibu')
                            ->required()
                            ->options([
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Katolik' => 'Katolik',
                                'Hindu' => 'Hindu',
                                'Buddha' => 'Buddha',
                                'Konghucu' => 'Konghucu',
                            ]),

                        Select::make('pendidikan_ibu')
                            ->required()
                            ->options([
                                'SD/Sederajat' => 'SD/Sederajat',
                                'SMP/Sederajat' => 'SMP/Sederajat',
                                'SMA/Sederajat' => 'SMA/Sederajat',
                                'D3' => 'D3',
                                'S1' => 'S1',
                                'S2' => 'S2',
                                'S3' => 'S3',
                            ]),

                        TextInput::make('pekerjaan_ibu')->required(),
                        TextInput::make('penghasilan_ibu')
                            ->numeric()
                            ->prefix('Rp'),
                        TextInput::make('nomor_telepon_ibu')
                            ->tel(),
                        Textarea::make('alamat_ibu')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ]),

                /*
                |--------------------------------------------------------------------------
                | UPLOAD FILE
                |--------------------------------------------------------------------------
                */

                Section::make('Upload Berkas')
                    ->description('Format PDF/JPG/PNG maksimal 2MB')
                    ->icon('heroicon-o-cloud-arrow-up')
                    ->collapsible()
                    ->schema([
                        FileUpload::make('ijazah_file_path')
                            ->label('Ijazah / SKL')
                            ->disk('public')
                            ->directory('berkas/ijazah')
                            ->acceptedFileTypes([
                                'application/pdf',
                                'image/jpeg',
                                'image/png',
                            ])
                            ->maxSize(5120)
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->panelLayout('compact'),

                        FileUpload::make('kk_file_path')
                            ->label('Kartu Keluarga')
                            ->disk('public')
                            ->directory('berkas/kk')
                            ->acceptedFileTypes([
                                'application/pdf',
                                'image/jpeg',
                                'image/png',
                            ])
                            ->maxSize(5120)
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->panelLayout('compact'),

                        FileUpload::make('akta_file_path')
                            ->label('Akta Kelahiran')
                            ->disk('public')
                            ->directory('berkas/akta')
                            ->acceptedFileTypes([
                                'application/pdf',
                                'image/jpeg',
                                'image/png',
                            ])
                            ->maxSize(5120)
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->panelLayout('compact'),
                    ])
                    ->columns(1),

                /*
                |--------------------------------------------------------------------------
                | ADMIN ONLY
                |--------------------------------------------------------------------------
                */

                /*
                |--------------------------------------------------------------------------
                | HASIL VALIDASI OCR
                |--------------------------------------------------------------------------
                */

                Section::make('Hasil Validasi OCR')
                    ->icon('heroicon-o-magnifying-glass')
                    ->collapsible()
                    ->visible(fn () => auth()->user()?->hasRole('admin'))
                    ->schema([
                        Placeholder::make('ocr_status')
                            ->label('Status Keseluruhan')
                            ->content(fn ($record) => match($record?->ocr_status) {
                                'passed' => '✅ Semua berkas lolos validasi',
                                'failed' => '❌ Ada berkas yang tidak lolos',
                                default  => '⏳ Belum dicek',
                            }),

                        Placeholder::make('ocr_checked_at')
                            ->label('Waktu Pengecekan')
                            ->content(fn ($record) =>
                                $record?->ocr_checked_at?->format('d M Y H:i') ?? '-'
                            ),

                        Placeholder::make('ocr_ijazah')
                            ->label('Validasi Ijazah / SKL')
                            ->content(fn ($record) =>
                                $record?->ocr_results['ijazah']['message'] ?? '— Belum dicek'
                            )
                            ->columnSpanFull(),

                        Placeholder::make('ocr_kk')
                            ->label('Validasi Kartu Keluarga')
                            ->content(fn ($record) =>
                                $record?->ocr_results['kk']['message'] ?? '— Belum dicek'
                            )
                            ->columnSpanFull(),

                        Placeholder::make('ocr_akta')
                            ->label('Validasi Akta Kelahiran')
                            ->content(fn ($record) =>
                                $record?->ocr_results['akta']['message'] ?? '— Belum dicek'
                            )
                            ->columnSpanFull(),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ]),

                /*Verifikasi */
                Section::make('Verifikasi Berkas')
                    ->icon('heroicon-o-shield-check')
                    ->visible(fn () => auth()->user()?->hasRole('admin'))
                    ->schema([

                        Select::make('status_verifikasi')
                            ->required()
                            ->options([
                                'belum_diverifikasi' => 'Belum Diverifikasi',
                                'diverifikasi' => 'Diverifikasi',
                                'ditolak' => 'Ditolak',
                            ])
                            ->default('belum_diverifikasi'),

                        Select::make('status_penerimaan')
                            ->required()
                            ->options([
                                'Menunggu' => 'Menunggu',
                                'Diterima' => 'Diterima',
                                'Ditolak' => 'Ditolak',
                            ])
                            ->default('Menunggu'),

                        Textarea::make('catatan_verifikasi')
                            ->rows(4)
                            ->columnSpanFull(),

                        Placeholder::make('verified_at')
                            ->label('Waktu Verifikasi')
                            ->content(fn ($record) =>
                                $record?->verified_at
                                    ? $record->verified_at->format('d M Y H:i')
                                    : '-'),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('created_at', 'desc')
            ->columns([

                TextColumn::make('nomor_pendaftaran')
                    ->label('No Pendaftaran')
                    ->searchable()
                    ->copyable()
                    ->sortable(),

                TextColumn::make('nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('asal_sekolah')
                    ->searchable()
                    ->limit(25),

                TextColumn::make('program_studi')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'IPA' => 'success',
                        'IPS' => 'warning',
                        'BAHASA' => 'info',
                        default => 'gray',
                    }),

                TextColumn::make('status_verifikasi')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'belum_diverifikasi' => 'Belum Diverifikasi',
                        'diverifikasi' => 'Diverifikasi',
                        'ditolak' => 'Ditolak',
                        default => '-',
                    })
                    ->color(fn ($state) => match ($state) {
                        'belum_diverifikasi' => 'gray',
                        'diverifikasi' => 'success',
                        'ditolak' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('status_penerimaan')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Menunggu' => 'warning',
                        'Diterima' => 'success',
                        'Ditolak' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->since(),
            ])

            ->filters([
                Tables\Filters\SelectFilter::make('program_studi')
                    ->options([
                        'IPA' => 'IPA',
                        'IPS' => 'IPS',
                        'BAHASA' => 'BAHASA',
                    ]),

                Tables\Filters\SelectFilter::make('status_verifikasi')
                    ->options([
                        'belum_diverifikasi' => 'Belum Diverifikasi',
                        'diverifikasi' => 'Diverifikasi',
                        'ditolak' => 'Ditolak',
                    ]),
            ])

            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Action::make('export_pdf')
                    ->label('PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function ($record) {
                        $safeName = preg_replace(
                            '/[^A-Za-z0-9_\-]/',
                            '_',
                            $record->nama ?? 'formulir'
                        );
                        return response()->streamDownload(function () use ($record) {
                            $pdf = Pdf::loadView('pdf.formulir', [
                                'data' => $record,
                            ])->setPaper('A4', 'portrait');
                            echo $pdf->output();
                        }, "Formulir_{$safeName}.pdf");
                    }),
                Action::make('recheck_ocr')
                    ->label('Cek Berkas')
                    ->icon('heroicon-o-magnifying-glass')
                    ->color('warning')
                    ->visible(fn () => auth()->user()?->hasRole('admin'))
                    ->action(function ($record) {
                        $job = new \App\Jobs\ValidateBerkasJob($record);
                        $job->handle(new \App\Services\OcrValidationService());
                        \Filament\Notifications\Notification::make()
                            ->title('Pengecekan OCR Selesai')
                            ->body('Hasil validasi berkas telah diperbarui.')
                            ->success()
                            ->send();
                    }),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => auth()->user()?->hasRole('admin')),
                ]),
            ])
            ->emptyStateHeading('Belum ada data pendaftaran')
            ->emptyStateDescription('Silakan buat pendaftaran baru.')
            ->emptyStateIcon('heroicon-o-document-text');
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (!auth()->user()->hasRole('admin')) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }

    public static function canCreate(): bool
    {
        return true;
    }

    public static function getNavigationBadge(): ?string
    {
        $count = Pendaftaran::where('status_penerimaan', 'Menunggu')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
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
