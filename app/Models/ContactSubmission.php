<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'service_interest', 'company', 'message', 'is_read'];
}
