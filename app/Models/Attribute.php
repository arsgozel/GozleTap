<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function values()
    {
        return $this->hasMany(AttributeValue::class)
            ->orderBy('sort_order');
    }


    public function getName()
    {
        if (app()->getLocale() == 'en') {
            return $this->name_en ?: $this->name_tm;
        } else {
            return $this->name_tm;
        }
    }
}
