<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Service extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
