<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
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
        'state_id',
        'created_by',
        'updated_by',
    ];

    /**
     * Get the state that city.
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
