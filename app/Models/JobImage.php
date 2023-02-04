<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobImage extends Model
{
    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
