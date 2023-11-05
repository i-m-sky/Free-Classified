<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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


    public static function boot()
    {
        parent::boot();

        static::saving(function ($row) {
            $row->created_by = Auth::id();
        });

        static::updating(function ($row) {
            $row->updated_by = Auth::id();
            if ($row->status == 'inactive') {
                DB::table('localities')->where('city_id', $row->id)->update(['status' => 'inactive']);
                DB::table('posts')->where('city_id', $row->id)->update(['status' => 'inactive']);
            }
        });
    }

    public function delete()
    {
        DB::table('localities')->where('city_id', $this->id)->delete();
        DB::table('posts')->where('city_id', $this->id)->delete();
        DB::table('cities')->where('id', $this->id)->delete();
    } //end delete


    /**
     * Get the state that city.
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function localities()
    {
        return $this->hasMany(Locality::class);
    }
}
