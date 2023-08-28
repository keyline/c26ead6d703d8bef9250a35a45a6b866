<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceAttribute extends Model
{
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_type_attribute')->withPivot('service_id')
        ->withTimestamps();
    }

    public function serviceTypes()
    {
        return $this->belongsToMany(ServiceType::class, 'service_type_attribute');
    }
    /**
     *
     public function relations(): HasMany
    {
        return $this->hasMany(ServiceTypeAttribute::class, 'service_attribute_id');

    }
     */



}
