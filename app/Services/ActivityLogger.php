<?php

namespace App\Services;

use App\Models\ActivityLog;

class ActivityLogger
{
    public static function log(string $action, string $description, $model = null): void
    {
        ActivityLog::create([
            'user_id'    => auth()->id(),
            'user_name'  => auth()->user()?->name ?? 'System',
            'action'     => $action,
            'model_type' => $model ? class_basename($model) : null,
            'model_id'   => $model?->id,
            'description'=> $description,
            'ip_address' => request()->ip(),
        ]);
    }

    public static function created($model, string $label): void
    {
        static::log('created', "Created {$label}: \"{$model->title}\"", $model);
    }

    public static function updated($model, string $label): void
    {
        static::log('updated', "Updated {$label}: \"{$model->title}\"", $model);
    }

    public static function deleted(string $label, string $title): void
    {
        static::log('deleted', "Deleted {$label}: \"{$title}\"");
    }

    public static function published($model, string $label): void
    {
        static::log('published', "Published {$label}: \"{$model->title}\"", $model);
    }
}
