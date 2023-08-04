<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ServiceAttribute extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'service_type_id',
        'service_id',
        'name',
        'description',
        'duration',
        'actual_amount',
        'slashed_amount',
        'status',
        'created_at',
        'updated_at',
    ];
}
