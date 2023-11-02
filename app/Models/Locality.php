<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'status',
        'state_id',
        'city_id',
        'created_by',
        'updated_by',
    ];

    /**
     * Get the state that locality.
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the city that locality.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
