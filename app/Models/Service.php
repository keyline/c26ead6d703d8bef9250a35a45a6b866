<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'image', 'mentor_bg_color'];


    public function serviceTypes()
    {
        return $this->belongsToMany(ServiceType::class, 'service_type_attribute')->withPivot(['service_id'])
        ->withTimestamps();

    }

    public function serviceAttributes()
    {
        return $this->belongsToMany(ServiceAttribute::class, 'service_type_attribute')->withPivot('service_type_id')
        ->withTimestamps();
    }






}
