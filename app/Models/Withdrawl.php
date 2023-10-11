<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawl extends Model
{
    use HasFactory;
    protected $fillable = [
        'mentor_id',
        'request_amount',
        'request_booking_ids',
    ];
}
