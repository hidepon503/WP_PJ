<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Cat extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'age',
        'kind_id',
        'user_id',
        'birthday',
        'weight',
        'soracom',
        'hellolight',
        'apple',
        'lostchild',
        'introduction',
        'admin_id',
        'gender_id',
        'status_id',
        'insuranceCard',
        ''
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthday)->age;
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_cats')
                    ->withPivot(['started_at', 'ended_at', 'relationship_type'])
                    ->withTimestamps();
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender');
    }

    public function kind()
    {
        return $this->belongsTo('App\Models\Kind');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function treatmentHistory()
    {
        return $this->hasMany('App\Models\TreatmentHistory');
    }

    public function matching()
    {
        return $this->hasMany('App\Models\Matching');
    }

    public function cat_image()
    {
        return $this->hasMany('App\Models\CatImage');
    }
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }




}
