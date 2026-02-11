<?php

namespace App\Traits;

use App\Models\Service;

trait ChecksServiceStatus
{
    public $isServiceOpen = true;

    public function checkServiceAvailability($slug)
    {
        $service = Service::where('slug', $slug)->first();

        if ($service && !$service->is_active) {
            $this->isServiceOpen = false;
        }
    }
}
