<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'birthday',
        'weight',
        'soracom',
        'hellolight',
        'apple',
        'lostchild'
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

}
