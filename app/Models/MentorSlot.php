<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorSlot extends Model
{
    use HasFactory;
    protected $fillable = [
        'mentor_user_id',
        'mentor_availability_id',
        'day_of_week_id',
        'duration',
        'from_time',
        'to_time'
    ];
}
