<?php

namespace App\Filament\Resources\ZawaNadzirSubmissionResource\Pages;

use App\Filament\Resources\ZawaNadzirSubmissionResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Service;

class CreateZawaNadzirSubmission extends CreateRecord
{
    protected static string $resource = ZawaNadzirSubmissionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $service = Service::where('slug', 'zawa-nadzir')->first();
        $data['service_id'] = $service->id;
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';
        return $data;
    }
}
