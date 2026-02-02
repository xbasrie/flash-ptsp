<?php

namespace App\Filament\Resources\ZawaTanahSubmissionResource\Pages;

use App\Filament\Resources\ZawaTanahSubmissionResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Service;

class CreateZawaTanahSubmission extends CreateRecord
{
    protected static string $resource = ZawaTanahSubmissionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $service = Service::where('slug', 'zawa-tanah')->first();
        $data['service_id'] = $service->id;
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';
        return $data;
    }
}
