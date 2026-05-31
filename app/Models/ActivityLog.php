<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id', 'user_name', 'action', 'model_type',
        'model_id', 'description', 'ip_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getActionColorAttribute(): string
    {
        return match($this->action) {
            'created'   => 'text-green-400',
            'updated'   => 'text-blue-400',
            'deleted'   => 'text-red-400',
            'published' => 'text-green-400',
            'approved'  => 'text-green-400',
            'rejected'  => 'text-red-400',
            'login'     => 'text-white/60',
            default     => 'text-gray-400',
        };
    }

    public function getActionIconAttribute(): string
    {
        return match($this->action) {
            'created'   => 'M12 4v16m8-8H4',
            'updated'   => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
            'deleted'   => 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16',
            'published' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
            'approved'  => 'M5 13l4 4L19 7',
            'login'     => 'M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1',
            default     => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        };
    }
}
