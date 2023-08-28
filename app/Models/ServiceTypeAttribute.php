<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceTypeAttribute extends Pivot
{
    use HasFactory;

    protected $table = 'service_type_attribute';

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function serviceDetails(): BelongsTo
    {
        return $this->belongsTo(ServiceDetail::class);
    }

    public function serviceTypes(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }

    public function serviceAttribute(): BelongsTo
    {
        return $this->belongsTo(ServiceAttribute::class);
    }
}
