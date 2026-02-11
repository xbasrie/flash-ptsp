<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('disable_all')
                ->label('Matikan Semua Layanan')
                ->color('danger')
                ->icon('heroicon-o-archive-box-x-mark')
                ->requiresConfirmation()
                ->modalHeading('Matikan Semua Layanan?')
                ->modalDescription('Apakah Anda yakin ingin menonaktifkan semua layanan? Pengguna tidak akan bisa mengajukan permohonan baru.')
                ->modalSubmitActionLabel('Ya, Matikan Semua')
                ->action(function () {
                    \App\Models\Service::query()->update(['is_active' => false]);
                    \Filament\Notifications\Notification::make()
                        ->title('Semua layanan berhasil dinonaktifkan')
                        ->success()
                        ->send();
                }),

            Actions\Action::make('enable_all')
                ->label('Aktifkan Semua Layanan')
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->requiresConfirmation()
                ->modalHeading('Aktifkan Semua Layanan?')
                ->modalDescription('Apakah Anda yakin ingin mengaktifkan kembali semua layanan?')
                ->modalSubmitActionLabel('Ya, Aktifkan Semua')
                ->action(function () {
                    \App\Models\Service::query()->update(['is_active' => true]);
                    \Filament\Notifications\Notification::make()
                        ->title('Semua layanan berhasil diaktifkan')
                        ->success()
                        ->send();
                }),
        ];
    }
}
