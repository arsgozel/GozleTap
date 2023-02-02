<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthAttempt extends Model
{
    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    const UPDATED_AT = null;


    public function ipAddress()
    {
        return $this->belongsTo(IpAddress::class);
    }


    public function userAgent()
    {
        return $this->belongsTo(UserAgent::class);
    }
}
