<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'sl_no',
        'booking_no',
        'mentor_id',
        'student_id',
        'mentor_service_id',
        'service_type_id',
        'service_attribute_id',
        'service_id',
        'booking_date',
        'booking_slot_from',
        'booking_slot_to',
        'booking_date_time',
        'duration',
        'discount',
        'payable_amt',
        'payment_status',
        'txn_id',
        'payment_amount',
        'payment_date_time',
        'payment_method',
        'payment_mode',
    ];
}
