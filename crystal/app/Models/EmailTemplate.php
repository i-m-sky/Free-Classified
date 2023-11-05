<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EmailTemplate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'status',
        'subject',
        'description',
        'notes',
        'created_by',
        'updated_by',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($row) {
            $row->created_by = Auth::id();
        });

        static::updating(function ($row) {
            $row->updated_by = Auth::id();
        });
    }
}
