<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MetaInformation extends Model{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_link',
        'page_slug',
        'page_title',
        'meta_keyword',
        'meta_description',
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
