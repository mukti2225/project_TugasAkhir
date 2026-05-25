<?php

namespace App\Filament\Resources\KritikSaranResource\Pages;

use App\Filament\Resources\KritikSaranResource;
use App\Mail\BalasanKritikSaranMail;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class ViewKritikSaran extends EditRecord
{
    protected static string $resource = KritikSaranResource::class;
    protected static ?string $title = 'Detail Pesan';

    protected function handleRecordUpdate($record, array $data): \Illuminate\Database\Eloquent\Model
    {
        if (!empty($data['balasan']) && !$record->dibalas_at) {
            $data['dibalas_at'] = now();
            $record->update($data);

            try {
                Mail::to($record->email)
                    ->queue(new BalasanKritikSaranMail($record));

                Notification::make()
                    ->title('Balasan berhasil dikirim')
                    ->body("Email terkirim ke {$record->email}")
                    ->success()
                    ->send();

            } catch (\Exception $e) {
                Notification::make()
                    ->title('Gagal mengirim email')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
            }
        } else {
            $record->update($data);
        }

        return $record;
    }

    protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label(fn () => $this->record->dibalas_at ? 'Sudah Dibalas' : 'Kirim Balasan')
            ->disabled(fn () => (bool) $this->record->dibalas_at)
            ->icon('heroicon-o-paper-airplane')
            ->color(fn () => $this->record->dibalas_at ? 'gray' : 'primary')
            ->submit('save');
    }

    protected function getCancelFormAction(): Action
    {
        return Action::make('cancel')
            ->label('Kembali')
            ->url($this->getResource()::getUrl('index'))
            ->color('gray');
    }

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
