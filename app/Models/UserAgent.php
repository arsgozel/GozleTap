<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAgent extends Model
{
    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function authAttempts()
    {
        return $this->hasMany(AuthAttempt::class)
            ->orderBy('id');
    }
}
