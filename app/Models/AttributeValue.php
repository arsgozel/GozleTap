<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }


    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_attribute_value')
            ->orderBy('id', 'desc');
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
