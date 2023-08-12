<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'full_name',
        'profile_pic',
    ];

    /**
     * Get the user that owns this profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
