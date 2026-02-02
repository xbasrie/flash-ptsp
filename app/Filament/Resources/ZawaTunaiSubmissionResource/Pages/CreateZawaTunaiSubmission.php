<?php

namespace App\Filament\Resources\ZawaTunaiSubmissionResource\Pages;

use App\Filament\Resources\ZawaTunaiSubmissionResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Service;

class CreateZawaTunaiSubmission extends CreateRecord
{
    protected static string $resource = ZawaTunaiSubmissionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $service = Service::where('slug', 'zawa-tunai')->first();
        $data['service_id'] = $service->id;
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';
        return $data;
    }
}
