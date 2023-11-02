<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'slug',
        'status',
        'description',
        'h1_title',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'sitemap',
        'no_follow',
        'meta_card',
        'created_by',
        'updated_by',
    ];
}
