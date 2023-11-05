<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class ReportPost extends Model
{
    use HasFactory;

    protected $table = 'post_reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'reason',
        'comment',
        'ip_address',
        'created_at'
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //'created_at' => 'datetime',
    ];


    /**
     * Get the post that report.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the member that report.
     */
    public function member()
    {
        return $this->belongsTo(Member::class,  'user_id', 'id');
    }


    /**
     * Get the user's first name.
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('Y-m-d', strtotime($value)),
        );
    }
}
