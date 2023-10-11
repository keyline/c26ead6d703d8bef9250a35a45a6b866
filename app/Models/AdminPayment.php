<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'mentor_id',
        'booking_id',
        'withdrawl_request_id',
        'opening_amt',
        'student_pay_amt',
        'closing_amt',
        'gst_percent',
        'gst_amount',
        'admin_commision',
        'mentor_commision',
    ];
}
