<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BerkasResource\Pages;
use App\Models\Berkas;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BerkasResource extends Resource
{
    protected static ?string $model = Berkas::class;

    protected static ?string $navigationLabel = 'Berkas Pendaftaran';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')->default(auth()->id()),
                FileUpload::make('akta_kelahiran')
                    ->label('Akta Kelahiran')
                    ->disk('public')
                    ->directory('berkas')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->downloadable()
                    ->openable()
                    ->required(),

                FileUpload::make('kartu_keluarga')
                    ->label('Kartu Keluarga')
                    ->disk('public')
                    ->directory('berkas')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->downloadable()
                    ->openable()
                    ->required(),

                FileUpload::make('ijazah')
                    ->label('Ijazah/SKL')
                    ->disk('public')
                    ->directory('berkas')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->downloadable()
                    ->openable()
                    ->required(),

                FileUpload::make('prestasi')
                    ->label('Prestasi')
                    ->disk('public')
                    ->directory('berkas')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->downloadable()
                    ->openable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchable(auth()->user()?->hasRole('admin') ?? false)
            ->paginated(auth()->user()?->hasRole('admin') ?? false)
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(auth()->user()?->hasRole('admin') ?? false),
                TextColumn::make('akta_kelahiran')
                    ->label('Akta Kelahiran')
                    ->url(fn ($record) => asset('storage/' . $record->akta_kelahiran))
                    ->openUrlInNewTab()
                    ->formatStateUsing(fn () => 'Lihat File'),

                TextColumn::make('kartu_keluarga')
                    ->label('Kartu Keluarga')
                    ->url(fn ($record) => asset('storage/' . $record->kartu_keluarga))
                    ->openUrlInNewTab()
                    ->formatStateUsing(fn () => 'Lihat File'),

                TextColumn::make('ijazah')
                    ->label('Ijazah/SKl')
                    ->url(fn ($record) => asset('storage/' . $record->ijazah))
                    ->openUrlInNewTab()
                    ->formatStateUsing(fn () => 'Lihat File'),

                TextColumn::make('prestasi')
                    ->label('Prestasi/Sertifikat')
                    ->formatStateUsing(fn ($state) => $state ? 'Lihat File' : '-')
                    ->url(fn ($record) => $record->prestasi 
                        ? asset('storage/' . $record->prestasi) 
                        : null
                    )
                    ->openUrlInNewTab()
                    ->disabled(fn ($record) => !$record->prestasi),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                ->visible(fn () => auth()->user()->hasRole('admin')),
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
            'index' => Pages\ListBerkas::route('/'),
            'create' => Pages\CreateBerkas::route('/create'),
            'edit' => Pages\EditBerkas::route('/{record}/edit'),
        ];
    }
}
