<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAttribute extends Model
{
    use HasFactory;

    public function service()
    {
        return $this->belongsToMany(Service::class, 'service_type_attribute')->withPivot('service_type_id')
        ->withTimestamps();
    }

    public function serviceType()
    {
        return $this->belongsToMany(ServiceType::class, 'service_type_attribute')->withPivot('service_id')
        ->withTimestamps();
    }
}
