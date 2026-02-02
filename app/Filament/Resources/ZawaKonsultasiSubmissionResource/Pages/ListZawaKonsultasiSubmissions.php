<?php

namespace App\Filament\Resources\ZawaKonsultasiSubmissionResource\Pages;

use App\Filament\Resources\ZawaKonsultasiSubmissionResource;
use Filament\Resources\Pages\ListRecords;

class ListZawaKonsultasiSubmissions extends ListRecords
{
    protected static string $resource = ZawaKonsultasiSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
