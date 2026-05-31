<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'viewable_type', 'viewable_id', 'session_id',
        'ip_hash', 'country', 'country_code', 'referer', 'user_agent', 'created_at',
    ];

    protected $casts = ['created_at' => 'datetime'];

    public function viewable()
    {
        return $this->morphTo();
    }
}
