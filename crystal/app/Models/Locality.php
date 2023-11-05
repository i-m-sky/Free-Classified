<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public static function boot()
    {
        parent::boot();

        static::saving(function ($row) {
            $row->created_by = Auth::id();
        });

        static::updating(function ($row) {
            $row->updated_by = Auth::id();
            if ($row->status == 'inactive') {
                DB::table('posts')->where('locality_id', $row->id)->update(['status' => 'inactive']);
            }
        });
    }

    public function delete()
    {
        DB::table('posts')->where('locality_id', $this->id)->delete();
        DB::table('localities')->where('id', $this->id)->delete();
    } //end delete


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
