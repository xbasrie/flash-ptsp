<?php

namespace App\Filament\Resources\ZawaTunaiSubmissionResource\Pages;

use App\Filament\Resources\ZawaTunaiSubmissionResource;
use Filament\Resources\Pages\ListRecords;

class ListZawaTunaiSubmissions extends ListRecords
{
    protected static string $resource = ZawaTunaiSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
