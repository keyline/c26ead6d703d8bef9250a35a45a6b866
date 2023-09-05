<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ServiceTypeAttribute;

class ServiceType extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'image'];


    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_type_attribute', 'service_id', 'service_type_id')->withPivot(['service_id', 'service_type_id', 'service_name'])
        //->using(ServiceTypeAttribute::class)
        ->withTimestamps();
        //return $this->belongsTo(Service::class);

    }

    public function serviceAttributes()
    {
        return $this->belongsToMany(ServiceAttribute::class, 'service_type_attribute')
        ->with('serviceTypes')
        ->withPivot(['service_type_id','service_id']);
        //return $this->belongsTo(ServiceAttribute::class);
    }

    /**
     *
     public function relations(): HasMany
    {
        return $this->hasMany(ServiceTypeAttribute::class, 'service_type_id');

    }
     */


}
