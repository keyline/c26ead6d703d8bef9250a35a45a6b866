<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Blog extends Model{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'blog_category',
        'title',
        'slug',
        'content_date',
        'short_description',
        'description',
        'image',
        'post_by',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
        
    // ];
}
