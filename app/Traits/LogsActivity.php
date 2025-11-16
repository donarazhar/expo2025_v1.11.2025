<?php

namespace App\Traits;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity as BaseLogsActivity;

trait LogsActivity
{
    use BaseLogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->getLogAttributes())
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn (string $eventName) => $this->getDescriptionForEvent($eventName));
    }

    protected function getLogAttributes(): array
    {
        // Override di masing-masing model
        return ['*'];
    }

    protected function getDescriptionForEvent(string $eventName): string
    {
        $modelName = class_basename($this);
        $userName = auth()->user()->name ?? 'System';

        return match ($eventName) {
            'created' => "{$userName} membuat {$modelName} baru",
            'updated' => "{$userName} mengupdate {$modelName}",
            'deleted' => "{$userName} menghapus {$modelName}",
            default => "{$userName} melakukan {$eventName} pada {$modelName}",
        };
    }

    // Custom log method
    public static function logCustomActivity(string $description, array $properties = [], string $logName = 'default')
    {
        activity($logName)
            ->performedOn(new static)
            ->causedBy(auth()->user())
            ->withProperties(array_merge($properties, [
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]))
            ->log($description);
    }
}
