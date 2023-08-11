<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory;

    public function serviceTypeAttribute()
    {
        return $this->hasMany(ServiceTypeAttribute::class, 'id');
    }
}
