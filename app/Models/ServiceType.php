<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable= ['name'];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_type_attribute');

    }

    public function serviceAttribute()
    {
        return $this->belongsToMany(ServiceAttribute::class, 'service_type_attribute');
    }
}
