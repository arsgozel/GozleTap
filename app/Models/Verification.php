<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function status()
    {
        if ($this->status == 0) {
            return trans('app.not-verified');
        } elseif ($this->status == 1) {
            return trans('app.verified');
        }
    }


    public function statusColor()
    {
        if ($this->status == 0) {
            return 'warning';
        } elseif ($this->status == 1) {
            return 'success';
        }
    }
}
