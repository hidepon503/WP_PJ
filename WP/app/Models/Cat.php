<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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
    ];

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender');
    }

    public function kind()
    {
        return $this->belongsTo('App\Models\Kind');
    }

    public function cat_image()
    {
        return $this->hasMany('App\Models\CatImage');
    }

}
