<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable= ['name', 'slug', 'description', 'image', 'mentor_bg_color'];

    public function serviceType()
    {
        return $this->belongsToMany(ServiceType::class, 'service_type_attribute');
    }

    public function serviceAttribute()
    {
        return $this->belongsToMany(ServiceAttribute::class, 'service_type_attribute');
    }


}
