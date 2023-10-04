<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserDocument extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'type',
        'user_id',
        'document_id',
        'document_slug',
        'document',
        'status'
    ];
}
