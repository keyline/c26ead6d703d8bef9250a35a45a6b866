<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'mentor_id',
        'booking_id',
        'withdrawl_request_id',
        'opening_amt',
        'transaction_amt',
        'closing_amt',
    ];
}
