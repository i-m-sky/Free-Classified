<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Member extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'isWhatsApp',
        'status',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime'
    ];


    public static function boot()
    {
        parent::boot();

        // Adding country id and created_by
        static::saving(function ($row) {
            $row->user_type = 2;
            $row->created_by = Auth::id();
        });

        //Updating any record
        static::updating(function ($row) {
            $row->updated_by = Auth::id();
            if ($row->status == 'inactive') {
                DB::table('posts')->where('user_id', $row->id)->update(['status' => 'inactive']);
            }
        });
    }

    public function delete()
    {
        DB::table('posts')->where('user_id', $this->id)->delete();
        DB::table('users')->where('id', $this->id)->delete();
    } //end delete

    // public function getCreatedAtAttribute()
    // {
    //     return  !empty($this->created_at) ? Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at, 'Asia/Kolkata')->format('M d Y') : '-';
    // }


    /**
     * Get the report for the  user.
     */
    public function reportUser(): HasMany
    {
        return $this->hasMany(ReportUser::class, 'report_user_id', 'id');
    }
}
