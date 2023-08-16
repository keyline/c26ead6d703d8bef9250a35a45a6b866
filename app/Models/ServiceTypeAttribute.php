<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ServiceTypeAttribute extends Pivot
{
    public function service()
    {
        return $this->belongsTo(Service::class, 'id');
    }

    public function serviceDetails()
    {
        return $this->belongsTo(ServiceDetail::class);
    }
}
