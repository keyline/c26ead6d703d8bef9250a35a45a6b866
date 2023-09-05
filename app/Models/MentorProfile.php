<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentorProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'display_name',
         'mobile',
        'full_name',
        'timezone',
    ];

    /**
     * Get the user that owns this profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mentorAvailabilities(): HasMany
    {
        return $this->hasMany(MentorAvailability::class);
    }

    public function serviceTypes(): BelongsToMany
    {
        return $this->belongsToMany(serviceTypes::class);

    }
}
