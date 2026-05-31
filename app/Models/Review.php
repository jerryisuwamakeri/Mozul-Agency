<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['name', 'company', 'position', 'content', 'rating', 'avatar', 'is_approved', 'is_featured'];
}
