<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'phone',
         'password',
        // 'remember_token',
        'role',
        'valid'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        //'password' => 'hashed',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
    * @return string
    */
    public function setPasswordAttribute($input)
    {
        //$this->attributes['password'] = bcrypt($value);

        //$this->attributes['password'] = Hash::make($value);

        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }


    }

    /**
     * Get the profile of the student associated with the user.
     */
    public function studentprofile(): HasOne
    {
        return $this->hasOne(StudentProfile::class, 'user_id', 'id');
    }

    /**
     * Get the profile of the mentor associated with the user.
     */
    public function mentorProfile(): HasOne
    {
        return $this->hasOne(MentorProfile::class, 'user_id', 'id');
    }

    /**
     * Get the services for the user.
     */
    public function serviceDetails(): HasMany
    {
        return $this->hasMany(ServiceDetail::class);
    }
}
