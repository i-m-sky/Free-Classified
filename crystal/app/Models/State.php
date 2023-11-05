<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class State extends Model
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
        'country_id',
        'created_by',
        'updated_by',
    ];

    public static function boot()
    {
        parent::boot();
        
        // Adding country id and created_by
        static::saving(function ($row) {
            $row->country_id = 1;
            $row->created_by = Auth::id();
        });

        //Updating any record
        static::updating(function ($row) {
            $row->updated_by = Auth::id();
            if ($row->status == 'inactive') {
                DB::table('cities')->where('state_id', $row->id)->update(['status' => 'inactive']);
                DB::table('localities')->where('state_id', $row->id)->update(['status' => 'inactive']);
                DB::table('posts')->where('state_id', $row->id)->update(['status' => 'inactive']);
            }
        });
    }

    public function delete()
    {
        DB::table('cities')->where('state_id', $this->id)->delete();
        DB::table('localities')->where('state_id', $this->id)->delete();
        DB::table('posts')->where('state_id', $this->id)->delete();
        DB::table('states')->where('id', $this->id)->delete();
    } //end delete

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
