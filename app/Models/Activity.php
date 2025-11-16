<?php

namespace App\Models;

use Spatie\Activitylog\Models\Activity as BaseActivity;

class Activity extends BaseActivity
{
    protected $fillable = [
        'log_name',
        'description',
        'subject_type',
        'subject_id',
        'causer_type',
        'causer_id',
        'properties',
        'event',
        'batch_uuid',
        'ip_address',
        'user_agent',
        'module',
        'action_type',
    ];

    protected $casts = [
        'properties' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scopes
    public function scopeByModule($query, $module)
    {
        return $query->where('module', $module);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('causer_id', $userId);
    }

    public function scopeByAction($query, $action)
    {
        return $query->where('action_type', $action);
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // Accessors
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y H:i:s');
    }

    public function getCauserNameAttribute()
    {
        return $this->causer ? $this->causer->name : 'System';
    }
}
