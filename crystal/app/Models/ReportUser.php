<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ReportUser extends Model
{
    use HasFactory;

    protected $table = 'user_reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'report_user_id',
        'reason',
        'comment',
        'ip_address',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Get the report member that report.
     */
    public function reportMember()
    {
        return $this->belongsTo(Member::class,  'report_user_id', 'id');
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
