<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'facebook_url',
        'twitter_url',
        'youTube_url',
        'footer_copyright',
        'saftey_tips',
        'google_code',
        'negative_keyword',
    ];

}
