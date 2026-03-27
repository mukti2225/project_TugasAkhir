<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormulirResource\Pages;
use App\Models\Formulir;
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
    protected static ?string $model = Formulir::class;

    protected static ?string $navigationLabel = 'Formulir Pendaftaran';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('KETERANGAN DATA PRIBADI')
                ->schema([
                    Hidden::make('user_id')->default(auth()->id()),
                    TextInput::make('nama')->label('Nama Lengkap Siswa')->required()->maxLength(255),
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
                            'Budha' => 'Budha',
                            'Konghucu' => 'Konghucu',
                        ])->required(),
                    TextInput::make('anak')->label('Anak Ke-')->numeric()->required(),
                    Select::make('status')->label('Status Anak')
                        ->options([
                            'Kandung' => 'Anak Kandung',
                            'Tiri' => 'Anak Tiri',
                            'Angkat' => 'Anak Angkat (Adopsi)',
                            'Asuh' => 'Anak Asuh',
                        ])->required(),
                ])->columns(2),

                Section::make('KETERANGAN TEMPAT TINGGAL')
                ->schema([
                    TextInput::make('alamat')->label('Alamat')->required(),
                    TextInput::make('jalan')->label('Jalan')->required(),
                    TextInput::make('rt_rw')->label('RT/RW')->required(),
                    TextInput::make('kelurahan')->label('Kelurahan')->required(),
                    TextInput::make('kecamatan')->label('Kecamatan')->required(),
                    TextInput::make('kota')->label('Kota')->required(),
                    TextInput::make('nomor_telepon')->label('Nomor Telepon Rumah')->tel()->placeholder('08xxxxxxxxxx')->nullable(),
                    TextInput::make('nomor_telepon_siswa')->label('Nomor Telepon Siswa')->tel()->placeholder('08xxxxxxxxxx')->nullable(),
                    Select::make('tinggal')
                        ->options([
                            'Bersama Orang Tua' => 'Bersama Orang Tua',
                            'Bersama Wali' => 'Bersama Wali',
                            'Saudara' => 'Saudara',
                            'Kost' => 'Kost',
                        ])->label('Tinggal Dengan')->required(),
                    TextInput::make('jarak_sekolah')->label('Jarak Tempat Tinggal ke Sekolah (Km)')->required(),
                ])->columns(2),

                Section::make('KETERANGAN PENDIDIKAN SEBELUMNYA')
                ->schema([
                    Select::make('pendidikan')->label('Pendidikan Terakhir')
                        ->options([
                            'SD' => 'SD',
                            'MI' => 'MI',
                            'SMP' => 'SMP',
                            'MTs' => 'MTs',
                            'Paket A/B' => 'Paket A/B',
                        ])->required(),
                    TextInput::make('nisn')->unique(ignoreRecord: true)->label('NISN')->tel()->rules(['digits:10'])->required(),
                    TextInput::make('ijazah')->label('Nomor Ijazah')->tel()->required(),
                    TextInput::make('asal_sekolah')->label('Asal Sekolah')->required(),
                    TextInput::make('pindahan')->label('Alasan Pindah (Pindahan)')->nullable(),
                    Select::make('program_studi')->label('Program Studi Pilihan')
                        ->options([
                            'IPA' => 'IPA',
                            'IPS' => 'IPS',
                            'Bahasa' => 'Bahasa',
                        ])->required(),
                ])->columns(2),

                Section::make('KETERANGAN AYAH KANDUNG')
                ->schema([
                    TextInput::make('nama_ayah')->label('Nama')->required(),
                    TextInput::make('tempat_lahir_ayah')->label('Tempat Lahir')->required(),
                    DatePicker::make('tanggal_lahir_ayah')->label('Tanggal Lahir')->required(),
                    Select::make('agama_ayah')->label('Agama')
                        ->options([
                            'Islam' => 'Islam',
                            'Kristen' => 'Kristen',
                            'Katolik' => 'Katolik',
                            'Hindu' => 'Hindu',
                            'Budha' => 'Budha',
                            'Konghucu' => 'Konghucu',
                        ])->required(),
                    Select::make('pendidikan_ayah')->label('Pendidikan')
                        ->options([
                            'SD/MI' => 'SD / MI',
                            'SMP/MTs' => 'SMP / MTs',
                            'SMA/SMK/MA' => 'SMA / SMK / MA',
                            'Diploma(D1,D2,D3,D4)' => 'Diploma (D1, D2, D3, D4)',
                            'Sarjana(S1)' => 'Sarjana (S1)',
                            'Magister(S2)' => 'Magister (S2)',
                            'Doktor(S3)' => 'Doktor (S3)',
                        ])->required(),
                    TextInput::make('pekerjaan_ayah')->label('Pekerjaan')->required(),
                    TextInput::make('penghasilan_ayah')->label('Penghasilan')->prefix('Rp')->required()
                        ->formatStateUsing(fn ($state) => 
                            $state ? number_format($state, 0, ',', '.') : null)
                        ->dehydrateStateUsing(fn ($state) => 
                            $state ? str_replace('.', '', $state) : null),
                    TextInput::make('nomor_telepon_ayah')->tel()->label('Nomor Telepon')->placeholder('08xxxxxxxxxx')->nullable(),
                    Textarea::make('alamat_ayah')->label('Alamat')->required()->columnSpanFull(),
                ])->columns(2),

                Section::make('KETERANGAN IBU KANDUNG')
                ->schema([
                    TextInput::make('nama_ibu')->label('Nama')->required(),
                    TextInput::make('tempat_lahir_ibu')->label('Tempat Lahir')->required(),
                    DatePicker::make('tanggal_lahir_ibu')->label('Tanggal Lahir')->required(),
                    Select::make('agama_ibu')->label('Agama')
                        ->options([
                            'Islam' => 'Islam',
                            'Kristen' => 'Kristen',
                            'Katolik' => 'Katolik',
                            'Hindu' => 'Hindu',
                            'Budha' => 'Budha',
                            'Konghucu' => 'Konghucu',
                    ])->required(),
                    Select::make('pendidikan_ibu')->label('Pendidikan')
                        ->options([
                            'SD/MI' => 'SD / MI',
                            'SMP/MTs' => 'SMP / MTs',
                            'SMA/SMK/MA' => 'SMA / SMK / MA',
                            'Diploma(D1,D2,D3,D4)' => 'Diploma (D1, D2, D3, D4)',
                            'Sarjana(S1)' => 'Sarjana (S1)',
                            'Magister(S2)' => 'Magister (S2)',
                            'Doktor(S3)' => 'Doktor (S3)',
                        ])->required(),
                    TextInput::make('pekerjaan_ibu')->label('Pekerjaan')->required(),
                    TextInput::make('penghasilan_ibu')->label('Penghasilan')->prefix('Rp')->required()
                        ->formatStateUsing(fn ($state) => 
                            $state ? number_format($state, 0, ',', '.') : null)
                        ->dehydrateStateUsing(fn ($state) => 
                            $state ? str_replace('.', '', $state) : null),
                    TextInput::make('nomor_telepon_ibu')->label('Nomor Telepon')->placeholder('08xxxxxxxxxx')->tel()->nullable(),
                    Textarea::make('alamat_ibu')->label('Alamat')->required()->columnSpanFull(),
                ])->columns(2),

                Section::make('KETERANGAN WALI')
                ->schema([
                    TextInput::make('nama_wali')->label('Nama'),
                    TextInput::make('tempat_lahir_wali')->label('Tempat Lahir'),
                    DatePicker::make('tanggal_lahir_wali')->label('Tanggal Lahir'),
                    Select::make('agama_wali')->label('Agama')
                        ->options([
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Katolik' => 'Katolik',
                                'Hindu' => 'Hindu',
                                'Budha' => 'Budha',
                                'Konghucu' => 'Konghucu',
                        ]),
                    Select::make('pendidikan_wali')->label('Pendidikan')
                        ->options([
                            'SD/MI' => 'SD / MI',
                            'SMP/MTs' => 'SMP / MTs',
                            'SMA/SMK/MA' => 'SMA / SMK / MA',
                            'Diploma(D1,D2,D3,D4)' => 'Diploma (D1, D2, D3, D4)',
                            'Sarjana(S1)' => 'Sarjana (S1)',
                            'Magister(S2)' => 'Magister (S2)',
                            'Doktor(S3)' => 'Doktor (S3)',
                        ]),
                    TextInput::make('pekerjaan_wali')->label('Pekerjaan')->nullable(),
                    TextInput::make('penghasilan_wali')->label('Penghasilan')->prefix('Rp')->nullable(),
                    TextInput::make('nomor_telepon_wali')->tel()->label('Nomor Telepon')->rule('regex:/^(\+62|08)[0-9]{8,13}$/')->nullable(),
                    Textarea::make('alamat_wali')->columnSpanFull()->label('Alamat')->nullable(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchable(auth()->user()?->hasRole('admin') ?? false)
            ->paginated(auth()->user()?->hasRole('admin') ?? false)
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(auth()->user()?->hasRole('admin') ?? false),

                TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable(),

                TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin'),

                TextColumn::make('kota')
                    ->searchable(),

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
