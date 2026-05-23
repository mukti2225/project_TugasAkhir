<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisiMisiResource\Pages;
use App\Filament\Resources\VisiMisiResource\RelationManagers;
use App\Models\VisiMisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisiMisiResource extends Resource
{
    protected static ?string $model = VisiMisi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    protected static ?string $navigationGroup = 'Profile';

    protected static ?string $navigationLabel = 'Visi Misi Sekolah';
    protected static ?int $navigationSort = 1;

    protected static ?string $pluralModelLabel = 'Visi Misi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Visi Sekolah')
                    ->description('Masukkan visi utama sekolah')
                    ->icon('heroicon-o-eye')
                    ->schema([
                        Forms\Components\Textarea::make('visi')
                            ->label('Visi')
                            ->required()
                            ->placeholder('Tuliskan visi sekolah...')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Misi Sekolah')
                    ->description('Masukkan daftar misi sekolah')
                    ->icon('heroicon-o-rocket-launch')
                    ->schema([
                        Forms\Components\RichEditor::make('misi')
                            ->label('Misi')
                            ->required()
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
                            ->placeholder('Tuliskan misi sekolah...')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchable(false)
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('visi')
                    ->label('Visi Sekolah')
                    ->formatStateUsing(fn ($state) => strip_tags($state))
                    ->lineClamp(1)
                    ->limit(40),

                Tables\Columns\TextColumn::make('misi')
                    ->label('Misi Sekolah')
                    ->formatStateUsing(fn ($state) => strip_tags($state))
                    ->lineClamp(1)
                    ->limit(40),
            ])

            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton(),
            ])
            ->emptyStateHeading('Belum ada visi misi')
            ->emptyStateDescription('Tambahkan visi dan misi sekolah.')
            ->emptyStateIcon('heroicon-o-academic-cap');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return VisiMisi::count() === 0;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisiMisis::route('/'),
            'create' => Pages\CreateVisiMisi::route('/create'),
            'edit' => Pages\EditVisiMisi::route('/{record}/edit'),
        ];
    }
}
