<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\TrackingLog;

class Submission extends Model
{
    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function logs()
    {
        return $this->hasMany(TrackingLog::class);
    }
}
