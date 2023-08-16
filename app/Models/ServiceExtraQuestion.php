<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceExtraQuestion extends Model
{
    use HasFactory;

    public function serviceAttribute(): hasMany
    {
        return $this->belongsTo(ServiceAttribute::class);
    }
}
