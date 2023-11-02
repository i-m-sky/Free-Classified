<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPhoneViewHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor',
        'phone',
        'user_id',
        'visitor_type'
    ];
}
