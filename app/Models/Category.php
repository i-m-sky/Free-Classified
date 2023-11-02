<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
        'created_by',
        'updated_by',
        'home_description'
    ];
}
