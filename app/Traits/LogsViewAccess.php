<?php

namespace App\Traits;

use App\Services\ActivityLogger;
use Filament\Resources\Pages\Page;

trait LogsViewAccess
{
    public function logViewAccess()
    {
        // Check if getRecord exists (standard in EditRecord/ViewRecord)
        if (method_exists($this, 'getRecord')) {
            $record = $this->getRecord();
            
            if ($record) {
                ActivityLogger::log(
                    'viewed',
                    'Melihat data: ' . class_basename($record),
                    $record
                );
            }
        }
    }
}
