<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory;

    protected $fillable =  [
        'service_attribute_id',
        'mentor_user_id',
        'title',
        'description',
        'duration',
        'sgst_amount',
        'cgst_amount',
        'igst_amount',
        'total_amount_payable',
        'platform_charges',
        'mentor_payout_amount',
        'promised_response_time',
        'sort_order',
        'countryid',
        'service_url',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the user that owns the service.
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the attribute that owns the service.
     */
    public function serviceAttributes(): BelongsTo
    {
        return $this->belongsTo(ServiceAttribute::class);
    }
}
