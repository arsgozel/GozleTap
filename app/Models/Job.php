<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Job extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];


    protected $casts = [
        'discount_start' => 'datetime',
        'discount_end' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::saving(function ($obj) {
            $obj->slug = str()->slug($obj->full_name_tm);
        });
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function gender()
    {
        return $this->belongsTo(AttributeValue::class, 'gender_id', 'id');
    }


    public function experience()
    {
        return $this->belongsTo(AttributeValue::class, 'experience_id');
    }


    public function work_time()
    {
        return $this->belongsTo(AttributeValue::class, 'work_time_id');
    }


    public function education()
    {
        return $this->belongsTo(AttributeValue::class, 'education_id');
    }


    public function location()
    {
        return $this->belongsTo(Location::class);
    }


    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'job_attribute_value')
            ->orderByPivot('sort_order');
    }


    public function images()
    {
        return $this->hasMany(JobImage::class)
            ->orderBy('id');
    }


    public function isOwner()
    {
        if ($this->user_id == auth()->id() or auth()->user()->isAdmin()) {
            return true;
        } else {
            return false;
        }
    }


    public function isNew()
    {
        if ($this->created_at >= Carbon::now()->subMonth()->toDateTimeString()) {
            return true;
        } else {
            return false;
        }
    }


    public function getFullName()
    {
        if (app()->getLocale() == 'en') {
            return $this->full_name_en ?: $this->full_name_tm;
        } else {
            return $this->full_name_tm;
        }
    }


    public function getName()
    {
        if (app()->getLocale() == 'en') {
            return $this->name_en ?: $this->name_tm;
        } else {
            return $this->name_tm;
        }
    }


    public function getImage()
    {
        return $this->image ? Storage::url('j/' . $this->image) : asset('img/job.jpg');
    }

    public function statusColor()
    {
        if ($this->is_approved == 1) {
            return 'success';
        } elseif ($this->is_approved == 0) {
            return 'danger';
        }
    }
}
