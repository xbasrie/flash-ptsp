<?php

namespace App\Traits;

use App\Services\ActivityLogger;
use Illuminate\Database\Eloquent\Model;

trait LogsActivity
{
    public static function bootLogsActivity()
    {
        static::created(function (Model $model) {
            ActivityLogger::log('created', 'Membuat data baru: ' . class_basename($model), $model);
        });

        static::updated(function (Model $model) {
            $changes = $model->getChanges();
            unset($changes['updated_at']);
            
            if (empty($changes)) {
                return;
            }

            $description = 'Mengupdate data ' . class_basename($model) . '. Perubahan: ' . json_encode($changes);
            ActivityLogger::log('updated', $description, $model);
        });

        static::deleted(function (Model $model) {
            ActivityLogger::log('deleted', 'Menghapus data: ' . class_basename($model), $model);
        });

        if (method_exists(static::class, 'restored')) {
            static::restored(function (Model $model) {
                ActivityLogger::log('restored', 'Mengembalikan data: ' . class_basename($model), $model);
            });
        }

        if (method_exists(static::class, 'forceDeleted')) {
            static::forceDeleted(function (Model $model) {
                ActivityLogger::log('force_deleted', 'Menghapus permanen data: ' . class_basename($model), $model);
            });
        }
    }
}
