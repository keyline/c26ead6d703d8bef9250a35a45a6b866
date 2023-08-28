<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email_verified_at',
        'display_name',
         'mobile',
         'social_url',
        'full_name',
        'registration_intent',
    ];

    /**
     * Get the user that owns this profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mentorAvailability(): HasMany
    {
        return $this->hasMany(MentorAvailability::class);
    }

    public function serviceTypes(): BelongsToMany
    {
        return $this->belongsToMany(serviceTypes::class);

    }
}
